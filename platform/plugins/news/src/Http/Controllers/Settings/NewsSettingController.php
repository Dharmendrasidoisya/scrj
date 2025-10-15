<?php

namespace Botble\News\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\News\Forms\Settings\NewsSettingForm;
use Botble\News\Http\Requests\Settings\NewsSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class NewsSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/news::base.settings.title'));

        return NewsSettingForm::create()->renderForm();
    }

    public function update(NewsSettingRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
