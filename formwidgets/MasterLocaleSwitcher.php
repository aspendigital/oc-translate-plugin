<?php

namespace AspenDigital\Translate\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use RainLab\Translate\Classes\Translator;
use RainLab\Translate\Models\Locale;

class MasterLocaleSwitcher extends FormWidgetBase
{
    public function render()
    {
        if (!Locale::isAvailable()) {
            return;
        }

        $this->vars['locales'] = Locale::listAvailable();
        
        return $this->makePartial('masterlocaleswitcher');
    }

    public function loadAssets()
    {
        $this->addJs('js/masterlocaleswitcher.js');
    }

    public function getSaveValue($value)
    {
        return FormField::NO_SAVE_DATA;
    }
}

