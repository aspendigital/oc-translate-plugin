<?php namespace AspenDigital\Translate\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'aspendigital_translate_settings';
    public $settingsFields = 'fields.yaml';
}
