<?php

namespace FriendsOfBotble\DisableRightClick\Http\Requests;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class SettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'fob_disable_right_click_enabled' => new OnOffRule(),
            'fob_disable_text_selection_enabled' => new OnOffRule(),
            'fob_disable_devtools_enabled' => new OnOffRule(),
        ];
    }
}
