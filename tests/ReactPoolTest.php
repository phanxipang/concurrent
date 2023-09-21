<?php

namespace Jenky\Atlas\Pool\Tests;

use Jenky\Atlas\Pool\Client\GuzzleClient;
use Jenky\Atlas\Pool\Client\ReactClient;
use Jenky\Atlas\Pool\Client\SymfonyClient;
use Jenky\Atlas\Pool\Concurrency\ReactDeferred;

final class ReactPoolTest extends TestCase
{
    private function createSymfonyClient(): SymfonyClient
    {
        return new SymfonyClient(new ReactDeferred());
    }

    private function createGuzzleClient(): GuzzleClient
    {
        return new GuzzleClient(new ReactDeferred());
    }

    // public function test_react_pool_using_react_browser(): void
    // {
    //     $this->performConnectorTests($this->createConnector(new ReactClient()));
    // }

    public function test_react_pool_using_symfony_http_client(): void
    {
        $this->performConnectorTests($this->createConnector($this->createSymfonyClient()));
    }

    public function test_react_pool_using_guzzle(): void
    {
        $this->performConnectorTests($this->createConnector($this->createGuzzleClient()));
    }
}
