<?php

namespace Xoptov\TradingBot\Event;

class Tick
{
    /** @var float */
    private $last;

    /** @var float */
    private $lowAsk;

    /** @var float */
    private $lowAskVolume;

    /** @var float */
    private $highBid;

    /** @var float */
    private $highBidVolume;

    /** @var float */
    private $change;

    /** @var float */
    private $baseVolume;

    /** @var float */
    private $quoteVolume;

    /** @var float */
    private $low24h;

    /** @var float */
    private $high24h;

    /**
     * Tick constructor.
     * @param float $last
     * @param float $lowAsk
     * @param float $lowAskVolume
     * @param float $highBid
     * @param float $highBidVolume
     * @param float $change
     * @param float $baseVolume
     * @param float $quoteVolume
     * @param float $low24h
     * @param float $high24h
     */
    public function __construct($last, $lowAsk, $lowAskVolume, $highBid, $highBidVolume, $change, $baseVolume, $quoteVolume, $low24h, $high24h)
    {
        $this->last = $last;
        $this->lowAsk = $lowAsk;
        $this->lowAskVolume = $lowAskVolume;
        $this->highBid = $highBid;
        $this->highBidVolume = $highBidVolume;
        $this->change = $change;
        $this->baseVolume = $baseVolume;
        $this->quoteVolume = $quoteVolume;
        $this->low24h = $low24h;
        $this->high24h = $high24h;
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
    public function getLowAskVolume()
    {
        return $this->lowAskVolume;
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
    public function getHighBidVolume()
    {
        return $this->highBidVolume;
    }

    /**
     * @return float
     */
    public function getChange()
    {
        return $this->change;
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
    public function getLow24h()
    {
        return $this->low24h;
    }

    /**
     * @return float
     */
    public function getHigh24h()
    {
        return $this->high24h;
    }
}