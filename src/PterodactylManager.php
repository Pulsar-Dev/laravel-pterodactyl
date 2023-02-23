<?php

namespace Pulsar\Pterodactyl;

use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Foundation\Application;
use Pulsar\Pterodactyl\Contracts\Factory;

class PterodactylManager implements Factory {
    protected array $instances = [];

    public function __construct(protected Application $app){}

    public function instance(?string $name = null): ?Pterodactyl {
        $name = $name ?: $this->getDefaultInstance();

        if (is_null($name)){
            return null;
        }

        if (!isset($this->instances[$name])){
            $this->instances[$name] = $this->resolve($name);
        }

        return $this->instances[$name];
    }

    protected function resolve(string $name): Pterodactyl {
        $config = $this->getConfig($name);

        return new Pterodactyl(
            $config['url'],
            $config['secret'],
            $config['type']
        );
    }

    protected function getConfig(string $name): array {
        return $this->app['config']["pterodactyl.hosts.{$name}"] ?: [];
    }

    public function getDefaultInstance(): ?string {
        return $this->app['config']['pterodactyl.default'];
    }
}
