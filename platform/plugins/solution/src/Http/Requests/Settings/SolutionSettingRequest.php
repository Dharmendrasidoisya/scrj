<?php

namespace Botble\Solution\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SolutionSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'solution_post_schema_enabled' => new OnOffRule(),
            'solution_post_schema_type' => [
                'nullable',
                'string',
                Rule::in(['NewsArticle', 'News', 'Article', 'SolutionPosting']),
            ],
        ];
    }
}
