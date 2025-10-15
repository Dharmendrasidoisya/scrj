<?php

namespace Botble\Solution\Forms\Settings;

use Botble\Solution\Http\Requests\Settings\solutionSettingRequest;
use Botble\Setting\Forms\SettingForm;

class SolutionSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/solution::base.settings.title'))
            ->setSectionDescription(trans('plugins/solution::base.settings.description'))
            ->setValidatorClass(SolutionSettingRequest::class)
            ->add('solution_setting', 'html', [
                'html' => view('plugins/solution::partials.solution-post-schema-fields'),
                'wrapper' => [
                    'class' => 'mb-0',
                ],
            ]);
    }
}
