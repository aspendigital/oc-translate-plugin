<?php

namespace AspenDigital\Translate\Components;

use RainLab\Translate\Components\LocalePicker;

class HomeLocalePicker extends LocalePicker
{
    /**
     * Override page URL to send any locale switch to home page
     */
    protected function makeLocaleUrlFromPage($locale)
    {
        return '';
    }
}