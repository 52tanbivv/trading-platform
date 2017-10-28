<?php

namespace Xoptov\TradingPlatform\Response\Ticker;

use Xoptov\TradingPlatform\Model\CurrencyPair;
use Xoptov\TradingPlatform\Model\Tick;

class Response
{
    /** @var Tick[] */
    private $ticks = array();

    /**
     * @return Tick[]
     */
    public function getTicks()
    {
        $ticks = array();

        foreach ($this->ticks as $tick) {
            $ticks[] = clone $tick;
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
     * @return int
     */
    public function addTick(CurrencyPair $currencyPair, $last, $lowAsk, $highBid, $baseVolume, $quoteVolume, $change)
    {
        $tick = new Tick($currencyPair, $last, $lowAsk, $highBid, $baseVolume, $quoteVolume, $change);

        return array_push($this->ticks, $tick);
    }
}