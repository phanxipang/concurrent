<?php

declare(strict_types=1);

namespace Fansipan\Peak\Client;

use Fansipan\Peak\Concurrency\Driver;
use Psr\Http\Client\ClientInterface;

interface AsyncClientInterface extends ClientInterface
{
    /**
     * Delay the request sending in milliseconds.
     *
     * @param  int<0, max> $milliseconds
     */
    public function delay(int $milliseconds): void;

    /**
     * Get the underlying async driver type.
     */
    public function driver(): ?Driver;
}
