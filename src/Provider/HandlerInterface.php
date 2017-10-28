<?php

namespace Xoptov\TradingBot\Provider;

use Xoptov\TradingBot\Event\Tick;
use Xoptov\TradingBot\Event\OrderBook;
use Xoptov\TradingBot\Event\Trade;

interface HandlerInterface
{
    /**
     * @param Tick $event
     */
    public function handleTick(Tick $event);

    /**
     * @param OrderBook $event
     */
    public function handleOrderBook(OrderBook $event);

    /**
     * @param Trade $event
     */
    public function handleTrade(Trade $event);
}