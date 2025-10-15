<?php

namespace Botble\Projects\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProjectsSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'projects_post_schema_enabled' => new OnOffRule(),
            'projects_post_schema_type' => [
                'nullable',
                'string',
                Rule::in(['NewsArticle', 'News', 'Article', 'ProjectsPosting']),
            ],
        ];
    }
}
