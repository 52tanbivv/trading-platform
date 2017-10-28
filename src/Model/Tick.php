<?php

namespace Xoptov\TradingPlatform\Model;

class Tick
{
    /** @var CurrencyPair */
    private $currencyPair;

    /** @var float */
    private $last;

    /** @var float */
    private $lowAsk;

    /** @var float */
    private $highBid;

    /** @var float */
    private $baseVolume;

    /** @var float */
    private $quoteVolume;

    /** @var float */
    private $change;

    /**
     * Tick constructor.
     * @param CurrencyPair $currencyPair
     * @param float $last
     * @param float $lowAsk
     * @param float $highBid
     * @param float $baseVolume
     * @param float $quoteVolume
     * @param float $change
     */
    public function __construct(CurrencyPair $currencyPair, $last, $lowAsk, $highBid, $baseVolume, $quoteVolume, $change)
    {
        $this->currencyPair = $currencyPair;
        $this->last = $last;
        $this->lowAsk = $lowAsk;
        $this->highBid = $highBid;
        $this->baseVolume = $baseVolume;
        $this->quoteVolume = $quoteVolume;
        $this->change = $change;
    }

    /**
     * @return CurrencyPair
     */
    public function getCurrencyPair()
    {
        return $this->currencyPair;
    }

    /**
     * @return float
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @return float
     */
    public function getLowAsk()
    {
        return $this->lowAsk;
    }

    /**
     * @return float
     */
    public function getHighBid()
    {
        return $this->highBid;
    }

    /**
     * @return float
     */
    public function getBaseVolume()
    {
        return $this->baseVolume;
    }

    /**
     * @return float
     */
    public function getQuoteVolume()
    {
        return $this->quoteVolume;
    }

    /**
     * @return float
     */
    public function getChange()
    {
        return $this->change;
    }
}