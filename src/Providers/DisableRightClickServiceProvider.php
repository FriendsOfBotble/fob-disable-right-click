<?php

namespace FriendsOfBotble\DisableRightClick\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DisableRightClickServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/fob-disable-right-click')
            ->loadAndPublishTranslations()
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
            
            add_filter(THEME_FRONT_HEADER, function (?string $html): ?string {
                if (is_in_admin()) {
                    return $html;
                }

                $disableRightClick = setting('fob_disable_right_click_enabled', true);
                $disableTextSelection = setting('fob_disable_text_selection_enabled', false);
                $disableDevTools = setting('fob_disable_devtools_enabled', false);

                if (! $disableRightClick && ! $disableTextSelection && ! $disableDevTools) {
                    return $html;
                }

                $js = '';

                if ($disableRightClick) {
                    $js .= <<<'JS'
                        document.addEventListener('contextmenu', function(e) {
                            e.preventDefault();
                        });
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'F12' || 
                                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) || 
                                (e.ctrlKey && e.key === 'u') || 
                                (e.metaKey && e.altKey && (e.key === 'i' || e.key === 'j' || e.key === 'u'))) {
                                e.preventDefault();
                            }
                        });
                    JS;
                }

                if ($disableTextSelection) {
                    $js .= <<<'JS'
                        document.addEventListener('DOMContentLoaded', function() {
                            document.body.style.userSelect = 'none';
                            document.body.style.webkitUserSelect = 'none';
                            document.body.style.msUserSelect = 'none';
                            document.body.style.mozUserSelect = 'none';
                        });
                        document.addEventListener('selectstart', function(e) {
                            e.preventDefault();
                        });
                    JS;
                }

                if ($disableDevTools) {
                    $js .= <<<'JS'
                        (function() {
                            const threshold = 160;
                            const checkWindowSize = function() {
                                if (window.outerWidth - window.innerWidth > threshold || window.outerHeight - window.innerHeight > threshold) {
                                    document.body.innerHTML = ''; 
                                    window.location.reload();
                                }
                            };
                            setInterval(checkWindowSize, 1000);
                        })();
                    JS;
                }

                return $html . '<script>' . $js . '</script>';
            }, 9999);
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


}
