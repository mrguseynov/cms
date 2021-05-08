<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateDashSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Spatie');
        $this->migrator->add('general.user_per_page', 10);
    }
}
