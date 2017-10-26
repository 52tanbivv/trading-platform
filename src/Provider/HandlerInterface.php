<?php

namespace Xoptov\TradingBot\Provider;

use Xoptov\TradingBot\Event\Tick;
use Xoptov\TradingBot\Event\Book;
use Xoptov\TradingBot\Event\Trade;

interface HandlerInterface
{
    /**
     * @param Tick[] $data
     */
    public function onTick(array $data);

    /**
     * @param Book[] $data
     */
    public function onBook(array $data);

    /**
     * @param Trade[] $data
     */
    public function onTrade(array $data);
}