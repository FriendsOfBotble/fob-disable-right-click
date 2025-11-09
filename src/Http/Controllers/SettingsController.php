<?php

namespace FriendsOfBotble\DisableRightClick\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Setting\Http\Controllers\SettingController;
use FriendsOfBotble\DisableRightClick\Forms\SettingForm;
use FriendsOfBotble\DisableRightClick\Http\Requests\SettingRequest;

class SettingsController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/fob-disable-right-click::disable-right-click.settings.title'));

        return SettingForm::create()->renderForm();
    }

    public function update(SettingRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
