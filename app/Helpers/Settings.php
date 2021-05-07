<?php
namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

class Settings
{
    public static function GetValue($key)
    {
        static $settings;
        if(is_null($settings))
        {
            $settings = Cache::remember('settings', 24*60, function() {
                return  Arr::pluck(Setting::all()->toArray(), 'value', 'key');
            });
        }
        Cache::flush('settings');//dont forget to remove
        return (is_array($key)) ? Arr::only($settings, $key) : $settings[$key];
    }
}
