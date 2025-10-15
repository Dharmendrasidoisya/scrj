<?php

namespace Botble\Projects\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Projects\Forms\Settings\ProjectsSettingForm;
use Botble\Projects\Http\Requests\Settings\ProjectsSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class ProjectsSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/projects::base.settings.title'));

        return ProjectsSettingForm::create()->renderForm();
    }

    public function update(ProjectsSettingRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
