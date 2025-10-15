<?php

namespace Botble\Industry\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Industry\Forms\Settings\IndustrySettingForm;
use Botble\Industry\Http\Requests\Settings\IndustrySettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class IndustrySettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/industry::base.settings.title'));

        return IndustrySettingForm::create()->renderForm();
    }

    public function update(IndustrySettingRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
