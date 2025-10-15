<?php

namespace Botble\Media\Chunks\Handler;

use Botble\Media\Chunks\Save\AbstractSave;
use Botble\Media\Chunks\Storage\ChunkStorage;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;

abstract class AbstractHandler
{
    protected array $config;

    public function __construct(protected Request $request, protected UploadedFile $file)
    {
        $this->config = RvMedia::getConfig('chunk', []);
    }

    /**
     * Checks the current setup if session driver was booted - if not, it will generate random hash.
     */
    public static function canUseSession(): bool
    {
        // Get the session driver and check if it was started - fully init by laravel
        $session = session();
        $driver = $session->getDefaultDriver();
        $drivers = $session->getDrivers();

        // Check if the driver is valid and started - allow using session
        if (isset($drivers[$driver]) && true === $drivers[$driver]->isStarted()) {
            return true;
        }

        return false;
    }

    /**
     * Builds the chunk file name per session and the original name. You can
     * provide custom additional name at the end of the generated file name. All chunk
     * files has .part extension.
     *
     * @param int|string|null $additionalName Make the name more unique (example: use id from request)
     * @param int|string|null $currentChunkIndex Add the chunk index for parallel upload
     *
     * @return string
     *
     * @see UploadedFile::getClientOriginalName()
     * @see Session::getId()
     */
   public function createChunkFileName($additionalName = null, $currentChunkIndex = null)
{
    // Get only safe base name (prevent directory traversal)
    $originalName = basename($this->file->getClientOriginalName());
    
    // Remove unsafe characters (allow only letters, numbers, dash, underscore, and dot)
    $safeName = preg_replace('/[^A-Za-z0-9_\.-]/', '_', $originalName);

    // Start building a safe filename
    $array = [$safeName];

    $useSession = $this->config['chunk']['name']['use']['session'];
    $useBrowser = $this->config['chunk']['name']['use']['browser'];

    if ($useSession && false === static::canUseSession()) {
        $useBrowser = true;
        $useSession = false;
    }

    // Append session ID (hashed for safety)
    if ($useSession) {
        $array[] = hash('sha256', Session::getId());
    }

    // Append browser info (hashed to avoid raw user data)
    if ($useBrowser) {
        $clientIdentifier = $this->request->ip() . $this->request->header('User-Agent', 'no-browser');
        $array[] = hash('sha256', $clientIdentifier);
    }

    // Optional additional name (also sanitized)
    if ($additionalName !== null) {
        $safeAdditional = preg_replace('/[^A-Za-z0-9_\.-]/', '_', $additionalName);
        $array[] = $safeAdditional;
    }

    // Build filename parts
    $namesSeparatedByDot = [implode('-', $array)];

    if (null !== $currentChunkIndex) {
        $namesSeparatedByDot[] = intval($currentChunkIndex); // ensure it's numeric
    }

    // Add secure extension
    $namesSeparatedByDot[] = ChunkStorage::CHUNK_EXTENSION;

    // Final sanitized name
    return implode('.', $namesSeparatedByDot);
}


    /**
     * Creates save instance and starts saving the uploaded file.
     *
     * @param ChunkStorage $chunkStorage the chunk storage
     *
     * @return AbstractSave
     */
    abstract public function startSaving($chunkStorage);

    /**
     * Returns the chunk file name for a storing the tmp file.
     *
     * @return string
     */
    abstract public function getChunkFileName();

    /**
     * Checks if the request has first chunked.
     *
     * @return bool
     */
    abstract public function isFirstChunk();

    /**
     * Checks if the current request has the last chunk.
     *
     * @return bool
     */
    abstract public function isLastChunk();

    /**
     * Checks if the current request is chunked upload.
     *
     * @return bool
     */
    abstract public function isChunkedUpload();

    /**
     * Returns the percentage of the upload file.
     *
     * @return float
     */
    abstract public function getPercentageDone();
}
