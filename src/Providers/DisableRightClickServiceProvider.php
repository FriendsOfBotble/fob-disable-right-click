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
        View::composer(['packages/theme::partials.header', '*::partials.header'], function (): void {
            // Don't inject on admin panel
            if (is_in_admin()) {
                return;
            }

            $disableRightClick = setting('fob_disable_right_click_enabled', true);
            $disableTextSelection = setting('fob_disable_text_selection_enabled', false);
            $disableDevTools = setting('fob_disable_devtools_enabled', false);

            if (! $disableRightClick && ! $disableTextSelection && ! $disableDevTools) {
                return;
            }

            echo '<script>';

            // Disable Right Click
            if ($disableRightClick) {
                echo <<<'JS'
                    document.addEventListener('contextmenu', function(e) {
                        e.preventDefault();
                    });

                    document.addEventListener('keydown', function(e) {
                        // F12
                        if (e.key === 'F12') {
                            e.preventDefault();
                        }
                        // Ctrl+Shift+I
                        if (e.ctrlKey && e.shiftKey && e.key === 'I') {
                            e.preventDefault();
                        }
                        // Ctrl+Shift+J
                        if (e.ctrlKey && e.shiftKey && e.key === 'J') {
                            e.preventDefault();
                        }
                        // Ctrl+U
                        if (e.ctrlKey && e.key === 'u') {
                            e.preventDefault();
                        }
                        // Cmd+Option+I (Mac)
                        if (e.metaKey && e.altKey && e.key === 'i') {
                            e.preventDefault();
                        }
                        // Cmd+Option+J (Mac)
                        if (e.metaKey && e.altKey && e.key === 'j') {
                            e.preventDefault();
                        }
                        // Cmd+Option+U (Mac)
                        if (e.metaKey && e.altKey && e.key === 'u') {
                            e.preventDefault();
                        }
                    });
                    JS;
            }

            // Disable Text Selection
            if ($disableTextSelection) {
                echo <<<'JS'
                    document.addEventListener('DOMContentLoaded', function() {
                        document.body.style.userSelect = 'none';
                        document.body.style.webkitUserSelect = 'none';
                        document.body.style.mozUserSelect = 'none';
                        document.body.style.msUserSelect = 'none';
                    });

                    document.addEventListener('selectstart', function(e) {
                        e.preventDefault();
                    });
                    JS;
            }

            // Disable DevTools
            if ($disableDevTools) {
                echo <<<'JS'
                    (function() {
                        const threshold = 160;
                        let devtoolsOpen = false;

                        // Method 1: Window size monitoring
                        const checkWindowSize = function() {
                            const widthDiff = window.outerWidth - window.innerWidth;
                            const heightDiff = window.outerHeight - window.innerHeight;

                            if (widthDiff > threshold || heightDiff > threshold) {
                                if (!devtoolsOpen) {
                                    devtoolsOpen = true;
                                    window.location.reload();
                                }
                            } else {
                                devtoolsOpen = false;
                            }
                        };

                        // Method 2: Debugger detection
                        const element = new Image();
                        Object.defineProperty(element, 'id', {
                            get: function() {
                                devtoolsOpen = true;
                                window.location.reload();
                                throw new Error('DevTools detected');
                            }
                        });

                        const checkConsole = function() {
                            console.log(element);
                        };

                        // Start monitoring
                        setInterval(checkWindowSize, 500);
                        setInterval(checkConsole, 1000);
                    })();
                    JS;
            }

            echo '</script>';
        });
    }
}
