<?php

namespace Spatie\LaravelPackageTools\Tests\PackageServiceProviderTests\InstallCommandTests;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;

// use function Spatie\PestPluginTestTime\testTime;

trait InstallAskToRunMigrationsTest
{
    public function configurePackage(Package $package)
    {
        //        testTime()->freeze('2020-01-01 00:00:00');

        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->askToRunMigrations();
            });
    }
}

uses(InstallAskToRunMigrationsTest::class);

it('can ask to run the migrations', function () {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful()
        ->expectsConfirmation('Would you like to run the migrations now?');
});
