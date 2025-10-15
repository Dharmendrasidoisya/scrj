<?php

namespace Botble\Projects\Http\Resources;

use Botble\Projects\Models\Post;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'content' => $this->content,
            'image' => $this->image ? RvMedia::url($this->image) : null,
            'projectscategories' => CategoryResource::collection($this->projectscategories),
            'projectstags' => TagResource::collection($this->projectstags),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
