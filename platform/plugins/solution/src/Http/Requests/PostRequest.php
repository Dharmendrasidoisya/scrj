<?php

namespace Botble\Solution\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Rules\MediaImageRule;
use Botble\Solution\Supports\PostFormat;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class PostRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:250',
            'description' => 'nullable|string|',
            'content' => 'nullable|string|max:300000',
            'stag' => 'nullable|string|max:255',
            'scategories' => 'sometimes|array',
            'scategories.*' => 'sometimes|exists:scategories,id',
            'status' => Rule::in(BaseStatusEnum::values()),
            'is_featured' => 'sometimes|boolean',
            'image' => ['nullable', 'string', new MediaImageRule()],
        ];

        $postFormats = PostFormat::getPostFormats(true);

        if (count($postFormats) > 1) {
            $rules['format_type'] = Rule::in(array_keys($postFormats));
        }

        return $rules;
    }
}
