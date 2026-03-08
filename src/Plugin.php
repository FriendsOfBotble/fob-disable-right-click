<?php

namespace FriendsOfBotble\DisableRightClick;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Facades\Setting;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Setting::delete([
            'fob_disable_right_click_enabled',
            'fob_disable_text_selection_enabled',
            'fob_disable_copy_enabled',
            'fob_disable_image_drag_enabled',
            'fob_disable_devtools_enabled',
        ]);
    }
}
