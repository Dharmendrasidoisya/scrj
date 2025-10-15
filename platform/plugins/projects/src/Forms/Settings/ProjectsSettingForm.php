<?php

namespace Botble\Projects\Forms\Settings;

use Botble\Projects\Http\Requests\Settings\ProjectsSettingRequest;
use Botble\Setting\Forms\SettingForm;

class ProjectsSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/projects::base.settings.title'))
            ->setSectionDescription(trans('plugins/projects::base.settings.description'))
            ->setSectionDescription(trans('plugins/projects::base.settings.shortdescription'))
            ->setValidatorClass(ProjectsSettingRequest::class)
            ->add('projects_setting', 'html', [
                'html' => view('plugins/projects::partials.projects-post-schema-fields'),
                'wrapper' => [
                    'class' => 'mb-0',
                ],
            ]);
    }
}
