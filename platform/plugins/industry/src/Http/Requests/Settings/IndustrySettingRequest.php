<?php

namespace Botble\Industry\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class IndustrySettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'industry_post_schema_enabled' => new OnOffRule(),
            'industry_post_schema_type' => [
                'nullable',
                'string',
                Rule::in(['NewsArticle', 'News', 'Article', 'IndustryPosting']),
            ],
        ];
    }
}
