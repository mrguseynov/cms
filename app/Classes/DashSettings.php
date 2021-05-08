<?php
namespace App\Classes;
use Spatie\LaravelSettings\Settings;

class DashSettings extends Settings
{
    public string $site_name;
    public int $user_per_page;

    public static function group(): string
    {
        return 'general';
    }
}
