<?php

namespace FriendsOfBotble\DisableRightClick\Forms;

use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Setting\Forms\SettingForm as BaseSettingForm;
use FriendsOfBotble\DisableRightClick\Http\Requests\SettingRequest;

class SettingForm extends BaseSettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/fob-disable-right-click::disable-right-click.settings.title'))
            ->setSectionDescription(trans('plugins/fob-disable-right-click::disable-right-click.settings.description'))
            ->setValidatorClass(SettingRequest::class)
            ->add(
                'fob_disable_right_click_enabled',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-disable-right-click::disable-right-click.settings.enable_right_click'))
                    ->helperText(trans('plugins/fob-disable-right-click::disable-right-click.settings.enable_right_click_help'))
                    ->defaultValue((bool) setting('fob_disable_right_click_enabled', true))
            )
            ->add(
                'fob_disable_text_selection_enabled',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-disable-right-click::disable-right-click.settings.enable_text_selection'))
                    ->helperText(trans('plugins/fob-disable-right-click::disable-right-click.settings.enable_text_selection_help'))
                    ->defaultValue((bool) setting('fob_disable_text_selection_enabled', false))
            )
            ->add(
                'fob_disable_devtools_enabled',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-disable-right-click::disable-right-click.settings.enable_devtools_detection'))
                    ->helperText(trans('plugins/fob-disable-right-click::disable-right-click.settings.enable_devtools_detection_help'))
                    ->defaultValue((bool) setting('fob_disable_devtools_enabled', false))
            );
    }
}
