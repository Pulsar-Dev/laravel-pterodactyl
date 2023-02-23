<?php

namespace Pulsar\Pterodactyl;

use Illuminate\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PterodactylServiceProvider extends PackageServiceProvider {
    public function configurePackage(Package $package): void {
        $package
            ->name('laravel-pterodactyl')
            ->hasConfigFile('pterodactyl');
    }

    public function boot(): void {
        $this->app->singleton(PterodactylManager::class, static function(Application $app){
            return new PterodactylManager($app);
        });
    }
}
