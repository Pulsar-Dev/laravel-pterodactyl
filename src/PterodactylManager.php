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

    /** Fetch an instance of the Pterodactyl API client from the given configuration.
     * @param ?string $name
     * @return ?Pterodactyl
     */
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

    /** Make a Pterodactyl API instance.
     * @param array $config
     * @return Pterodactyl
     * @throws InvalidArgumentException
     */
    public static function make(array $config): Pterodactyl {
        if (empty($config)){
            throw new InvalidArgumentException("Adhoc Host is not configured.");
        }
        if (empty($config['url'])){
            throw new InvalidArgumentException("Adhoc Host is missing its base URL.");
        }
        if (empty($config['type'])){
            throw new InvalidArgumentException("Adhoc Host is missing its API type.");
        }
        if (empty($config['secret'])){
            throw new InvalidArgumentException("Adhoc Host is missing its secret key.");
        }

        try {
            return new Pterodactyl(
                $config['url'],
                $config['secret'],
                $config['type']
            );
        } catch (InvaildApiTypeException $e){
            throw new InvalidArgumentException("Adhoc Host has an incorrect API type.");
        }
    }

    /** Resolve a given name to the configured Pterodactyl instance.
     * @param string $name
     * @return Pterodactyl
     */
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

    /** Get a given configuration from the settings.
     * @param string $name
     * @return array
     */
    protected function getConfig(string $name): array {
        return $this->app['config']["pterodactyl.hosts.{$name}"] ?: [];
    }

    /** Get the default configuration instance name.
     * @return ?string
     */
    public function getDefaultInstance(): ?string {
        return $this->app['config']['pterodactyl.default'];
    }
}
