<?php

namespace Pulsar\Pterodactyl;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PterodactylServiceProvider extends PackageServiceProvider {
    public function configurePackage(Package $package): void {
        $package
            ->name('laravel-pterodactyl')
            ->hasConfigFile();
    }
}
