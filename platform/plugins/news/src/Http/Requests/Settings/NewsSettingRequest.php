<?php

namespace Botble\News\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class NewsSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'news_post_schema_enabled' => new OnOffRule(),
            'news_post_schema_type' => [
                'nullable',
                'string',
                Rule::in(['NewsArticle', 'News', 'Article', 'NewsPosting']),
            ],
        ];
    }
}
