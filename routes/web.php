<?php

use Botble\Base\Facades\AdminHelper;
use FriendsOfBotble\DisableRightClick\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::group(['prefix' => 'settings/fob-disable-right-click', 'permission' => 'settings.options'], function (): void {
        Route::get('/', [SettingsController::class, 'edit'])->name('fob-disable-right-click.settings');
        Route::put('/', [SettingsController::class, 'update']);
    });
});
