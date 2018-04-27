<?php
namespace AspenDigital\Translate;

use Event;

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
        if (!$this->app->runningInBackend()) {
            return;
        }

        // Add "master" locale switcher to static page forms
        Event::listen('backend.form.extendFields', function($widget) {
            if (!$widget->model instanceof \RainLab\Pages\Classes\Page) {
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
}
