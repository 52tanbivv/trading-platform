<?php

namespace Xoptov\TradingBot\Provider;

use Xoptov\TradingBot\Event\Tick;
use Xoptov\TradingBot\Event\Book;
use Xoptov\TradingBot\Event\Trade;

interface HandlerInterface
{
    /**
     * @param Tick $event
     */
    public function onTick(Tick $event);

    /**
     * @param Book $event
     */
    public function onBook(Book $event);

    /**
     * @param Trade $event
     */
    public function onTrade(Trade $event);
}