<?php

namespace FriendsOfBotble\DisableRightClick\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Illuminate\Support\ServiceProvider;

class DisableRightClickServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/fob-disable-right-click')
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        PanelSectionManager::default()->beforeRendering(function (): void {
            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('fob-disable-right-click')
                    ->setTitle(trans('plugins/fob-disable-right-click::disable-right-click.settings.title'))
                    ->withDescription(trans('plugins/fob-disable-right-click::disable-right-click.settings.description'))
                    ->withIcon('ti ti-shield-lock')
                    ->withPriority(0)
                    ->withRoute('fob-disable-right-click.settings')
            );
        });

        $this->app->booted(function (): void {
            $this->registerMenuItems();
            $this->injectFrontendScript();
        });
    }

    protected function registerMenuItems(): void
    {
        DashboardMenu::default()->beforeRetrieving(function (): void {
            DashboardMenu::make()
                ->registerItem([
                    'id' => 'cms-plugins-fob-disable-right-click',
                    'priority' => 9999,
                    'parent_id' => 'cms-core-settings',
                    'name' => 'plugins/fob-disable-right-click::disable-right-click.name',
                    'route' => 'fob-disable-right-click.settings',
                ]);
        });
    }

    protected function injectFrontendScript(): void
    {
        add_filter(THEME_FRONT_HEADER, function (?string $html): ?string {
            if (is_in_admin()) {
                return $html;
            }

            $disableRightClick = (bool) setting('fob_disable_right_click_enabled', true);
            $disableTextSelection = (bool) setting('fob_disable_text_selection_enabled', false);
            $disableCopy = (bool) setting('fob_disable_copy_enabled', false);
            $disableImageDrag = (bool) setting('fob_disable_image_drag_enabled', false);
            $disableDevTools = (bool) setting('fob_disable_devtools_enabled', false);

            if (! $disableRightClick && ! $disableTextSelection && ! $disableCopy && ! $disableImageDrag && ! $disableDevTools) {
                return $html;
            }

            return $html . view('plugins/fob-disable-right-click::protection-script', compact(
                'disableRightClick',
                'disableTextSelection',
                'disableCopy',
                'disableImageDrag',
                'disableDevTools',
            ))->render();
        }, 999);
    }
}
