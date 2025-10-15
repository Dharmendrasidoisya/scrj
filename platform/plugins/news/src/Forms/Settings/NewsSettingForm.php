<?php

namespace Botble\News\Forms\Settings;

use Botble\News\Http\Requests\Settings\NewsSettingRequest;
use Botble\Setting\Forms\SettingForm;

class NewsSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/news::base.settings.title'))
            ->setSectionDescription(trans('plugins/news::base.settings.description'))
            ->setSectionDescription(trans('plugins/news::base.settings.shortdescription'))
            ->setValidatorClass(NewsSettingRequest::class)
            ->add('news_setting', 'html', [
                'html' => view('plugins/news::partials.news-post-schema-fields'),
                'wrapper' => [
                    'class' => 'mb-0',
                ],
            ]);
    }
}
