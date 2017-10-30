<?php

namespace Xoptov\TradingPlatform\Provider;

interface ProviderInterface
{
    const CHANNEL_TICKER = 1;
    const CHANNEL_ORDER_BOOK = 2;
    const CHANNEL_TRADE = 4;

    /**
     * @return void
     */
    public function start();

    /**
     * @param callable $handler
     * @return boolean
     */
    public function bindTick(callable $handler);

    /**
     * @param callable $handler
     * @return boolean
     */
    public function bindOrderBook(callable $handler);

    /**
     * @param callable $handler
     * @return boolean
     */
    public function bindTrade(callable $handler);
}