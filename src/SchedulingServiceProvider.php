<?php

namespace Tipoff\Scheduling;

use Illuminate\Support\Str;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Scheduling\Commands\SchedulingCommand;

class SchedulingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('scheduling')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                '2020_05_02_130000_create_schedule_erasers_table',
                '2020_05_02_150000_create_recurring_schedules_table',
                '2020_10_20_212605_rename_frequency_fields_in_recurring_schedules_table',
                '2020_10_23_051230_update_recurring_schedules',
                '2020_05_04_100000_create_slots_table',
                '2020_05_04_101000_create_blocks_table',
                '2020_05_04_102000_create_holds_table',
                '2020_05_04_110000_create_games_table.php',
            ])
            ->hasCommand(SchedulingCommand::class);
    }

    /**
     * Using packageBooted lifecycle hooks to override the migration file name.
     * We want to keep the old filename for now.
     */
    public function packageBooted()
    {
        foreach ($this->package->migrationFileNames as $migrationFileName) {
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    $this->package->basePath("/../database/migrations/{$migrationFileName}.php.stub") => database_path('migrations/' . Str::finish($migrationFileName, '.php')),
                ], "{$this->package->name}-migrations");
            }
        }
    }
}
