<?php

namespace Botble\Solution\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Solution\Forms\Settings\SolutionSettingForm;
use Botble\Solution\Http\Requests\Settings\SolutionSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class SolutionSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/solution::base.settings.title'));

        return SolutionSettingForm::create()->renderForm();
    }

    public function update(SolutionSettingRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
