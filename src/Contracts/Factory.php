<?php

namespace Pulsar\Pterodactyl\Contracts;

use HCGCloud\Pterodactyl\Pterodactyl;

interface Factory {
    /** Return a Pterodactyl SDK instance from a given configuration name.
     *
     * @param string|null $name
     * @return Pterodactyl|null
     */
    public function instance(?string $name = null): ?Pterodactyl;
}
