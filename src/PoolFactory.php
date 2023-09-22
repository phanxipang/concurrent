<?php

declare(strict_types=1);

namespace Fansipan\Peak;

use Fansipan\Peak\Client\AsyncClientFactory;
use Fansipan\Peak\Client\AsyncClientInterface;
use Jenky\Atlas\Contracts\ConnectorInterface;
use Psr\Http\Client\ClientInterface;

class PoolFactory
{
    public static function createForClient(ClientInterface $client): Pool
    {
        return new ClientPool(AsyncClientFactory::create($client));
    }

    public static function createForConnector(ConnectorInterface $connector): Pool
    {
        $client = $connector->client();

        if (! $client instanceof AsyncClientInterface) {
            if (! \method_exists($connector, 'withClient')) {
                // @codeCoverageIgnoreStart
                throw new \LogicException('Unable to swap the underlying client of connector '.\get_debug_type($connector));
                // @codeCoverageIgnoreEnd
            }

            $connector = $connector->withClient(AsyncClientFactory::create($client));
        }

        return new ConnectorPool($connector);
    }
}
