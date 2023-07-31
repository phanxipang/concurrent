<?php

declare(strict_types=1);

namespace Jenky\Atlas\Pool;

use Jenky\Concurrency\PoolInterface;

trait PoolTrait
{
    /**
     * @var positive-int
     */
    private int $concurrency = 25;

    /**
     * @param positive-int $concurrency
     *
     * @throws \ValueError
     */
    public function concurrent(int $concurrency): PoolInterface
    {
        if ($concurrency < 1) {
            throw new \ValueError('Argument #1 ($concurrency) must be positive, got '.$concurrency);
        }

        $clone = clone $this;
        $clone->concurrency = $concurrency;

        return $clone;
    }
}
