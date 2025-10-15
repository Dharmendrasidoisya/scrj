<?php

namespace Botble\Industry\Forms\Settings;

use Botble\Industry\Http\Requests\Settings\IndustrySettingRequest;
use Botble\Setting\Forms\SettingForm;

class IndustrySettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/industry::base.settings.title'))
            ->setSectionDescription(trans('plugins/industry::base.settings.description'))
            ->setSectionDescription(trans('plugins/industry::base.settings.shortdescription'))
            ->setValidatorClass(IndustrySettingRequest::class)
            ->add('industry_setting', 'html', [
                'html' => view('plugins/industry::partials.industry-post-schema-fields'),
                'wrapper' => [
                    'class' => 'mb-0',
                ],
            ]);
    }
}
