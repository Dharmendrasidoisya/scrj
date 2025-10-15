<?php

namespace Botble\Media\Services;

use Botble\Media\Facades\RvMedia;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToRetrieveMetadata;

class UploadsManager
{
    public function fileDetails(string $path): array
    {
        return [
            'filename' => File::basename($path),
            'url' => $path,
            'mime_type' => $this->fileMimeType(RvMedia::getRealPath($path)),
            'size' => $this->fileSize($path),
            'modified' => $this->fileModified($path),
        ];
    }

    public function fileMimeType(string $path): string|null
    {
        return RvMedia::getMimeType($path);
    }

    public function fileSize(string $path): int
    {
        try {
            return Storage::size($path);
        } catch (UnableToRetrieveMetadata) {
            return 0;
        }
    }

    public function fileModified(string $path): string
    {
        try {
            return Carbon::createFromTimestamp(Storage::lastModified($path));
        } catch (UnableToRetrieveMetadata) {
            return Carbon::now();
        }
    }

    public function createDirectory(string $folder): bool|string
    {
        $folder = $this->cleanFolder($folder);

        if (Storage::exists($folder)) {
            return trans('core/media::media.folder_exists', compact('folder'));
        }

        return Storage::makeDirectory($folder);
    }

    protected function cleanFolder(string $folder): string
    {
        return DIRECTORY_SEPARATOR . trim(str_replace('..', '', $folder), DIRECTORY_SEPARATOR);
    }

    public function deleteDirectory(string $folder): bool|string
    {
        $folder = $this->cleanFolder($folder);

        $filesFolders = array_merge(Storage::directories($folder), Storage::files($folder));

        if (! empty($filesFolders)) {
            return trans('core/media::media.directory_must_empty');
        }

        return Storage::deleteDirectory($folder);
    }

    public function deleteFile(string $path): bool
    {
        $path = $this->cleanFolder($path);

        return Storage::delete($path);
    }

   public function saveFile(
    string $path,
    string $content,
    UploadedFile $file = null,
    array $visibility = ['visibility' => 'public']
): bool {
    if (!RvMedia::isChunkUploadEnabled() || !$file) {
        return Storage::put($this->cleanFolder($path), $content, $visibility);
    }

    // ✅ Get base directory for chunks from config and sanitize it
    $baseChunkDir = rtrim(RvMedia::getConfig('chunk.storage.chunks'), '/');

    // ✅ Sanitize the user-supplied filename
    $originalFilename = $file->getFilename();
    $safeFilename = basename($originalFilename); // removes directory traversal like ../
    $safeFilename = preg_replace('/[^A-Za-z0-9_\.-]/', '_', $safeFilename); // allow only safe chars

    // ✅ Build a safe chunk path
    $currentChunksPath = $baseChunkDir . '/' . $safeFilename;

    // ✅ Use a trusted disk from config
    $disk = Storage::disk(RvMedia::getConfig('chunk.storage.disk'));

    try {
        // ✅ Read safely from the chunk storage
        $stream = $disk->getDriver()->readStream($currentChunksPath);

        // ✅ Clean destination path before saving
        $safeDestination = $this->cleanFolder($path);

        if ($result = Storage::writeStream($safeDestination, $stream, $visibility)) {
            // Delete the temporary chunk only if write was successful
            $disk->delete($currentChunksPath);
        }

        return $result;
    } catch (Exception|FilesystemException $e) {
        // Fallback: store directly if reading fails
        return Storage::put($this->cleanFolder($path), $content, $visibility);
    }
}

}
