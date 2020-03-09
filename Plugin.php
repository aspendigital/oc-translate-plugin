<?php
namespace AspenDigital\Translate;

use Event;
use RainLab\Translate\Classes\Translator;
use Response;
use View;
use AspenDigital\Translate\Models\Settings as Settings;

class Plugin extends \System\Classes\PluginBase
{
    public $requires = ['RainLab.Translate'];

    public function pluginDetails()
    {
        return [
            'name' => 'Multi-locale customizations',
            'description' => 'Customizations for RainLab.Translate plugin functionality',
            'author' => 'Aspen Digital',
            'icon' => 'icon-pencil'
        ];
    }

    public function boot()
    {
        // RainLab.Translate operates on the assumption that all content has a translation in every
        // locale, and if not, showing the default locale's content is acceptable. This overrides that
        // behavior for static pages so if the page doesn't have a URL or markup assigned for the current
        // locale, it's a 404.
        Event::listen('cms.page.beforeDisplay', function($controller, $url, $page) {
            $static_page_locale_routing = Settings::get('static_page_locale_routing');

            if (!$static_page_locale_routing || !$page || $url === '/') {
                return;
            }

            $staticPage = array_get($page->apiBag, 'staticPage');
            $locale = Translator::instance()->getLocale();

            if ($staticPage && !$staticPage->hasTranslatablePageUrl($locale) && !$staticPage->hasTranslation('markup', $locale)) {
                $page404 = $controller->getRouter()->findByUrl('/404');
                return $page404 ?: Response::make(View::make('cms::404'), 404);
            }
        });

        if (!$this->app->runningInBackend()) {
            return;
        }

        // Add "master" locale switcher to static page forms
        Event::listen('backend.form.extendFields', function($widget) {
            if (!$widget->model instanceof \RainLab\Pages\Classes\Page || $widget->isNested) {
                return;
            }

            $widget->addFields([
                '_locale' => [
                    'type' => FormWidgets\MasterLocaleSwitcher::class
                ]
            ]);
        });
    }

    public function registerComponents()
    {
        return [
            Components\HomeLocalePicker::class => 'homeLocalePicker'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Translate',
                'description' => 'Manage translation options.',
                'icon'        => 'icon-language',
                'class'       => 'AspenDigital\Translate\Models\Settings',
                'order'       => 100,
                'keywords'    => '',
                'permissions' => ['aspendigital.translate.manage_translate_options']
            ]
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'aspendigital.translate.manage_translate_options' => [
                'tab' => 'Translate',
                'label' => 'Manage translation options.'
            ]
        ];
    }
}
