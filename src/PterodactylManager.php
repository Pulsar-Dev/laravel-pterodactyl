<?php

namespace Pulsar\Pterodactyl;

use InvalidArgumentException;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Foundation\Application;
use Pulsar\Pterodactyl\Contracts\Factory;
use HCGCloud\Pterodactyl\Exceptions\InvaildApiTypeException;

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

        if (empty($config)){
            throw new InvalidArgumentException("Host [{$name}] is not configured.");
        }
        if (empty($config['url'])){
            throw new InvalidArgumentException("Host [{$name}] is missing its base URL.");
        }
        if (empty($config['type'])){
            throw new InvalidArgumentException("Host [{$name}] is missing its API type.");
        }

        try {
            return new Pterodactyl(
                $config['url'],
                $config['secret'],
                $config['type']
            );
        } catch (InvaildApiTypeException $e){
            throw new InvalidArgumentException("Host [{$name}] has an incorrect API type.");
        }
    }

    protected function getConfig(string $name): array {
        return $this->app['config']["pterodactyl.hosts.{$name}"] ?: [];
    }

    public function getDefaultInstance(): ?string {
        return $this->app['config']['pterodactyl.default'];
    }
}
