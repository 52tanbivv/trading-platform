<?php

namespace Xoptov\TradingPlatform\Response\Ticker;

use SplDoublyLinkedList;
use Xoptov\TradingPlatform\Model\Tick;
use Xoptov\TradingPlatform\Model\CurrencyPair;

class Response
{
    /** @var SplDoublyLinkedList */
    private $ticks;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->ticks = new SplDoublyLinkedList();
    }

    /**
     * @return SplDoublyLinkedList
     */
    public function getTicks()
    {
        $ticks = new SplDoublyLinkedList();

        foreach ($this->ticks as $tick) {
            $ticks->push(clone $tick);
        }

        return $ticks;
    }

    /**
     * @param CurrencyPair $currencyPair
     * @param float $last
     * @param float $lowAsk
     * @param float $highBid
     * @param float $baseVolume
     * @param float $quoteVolume
     * @param float $change
     */
    public function addTick(CurrencyPair $currencyPair, $last, $lowAsk, $highBid, $baseVolume, $quoteVolume, $change)
    {
        $this->ticks->push(new Tick($currencyPair, $last, $lowAsk, $highBid, $baseVolume, $quoteVolume, $change));
    }
}