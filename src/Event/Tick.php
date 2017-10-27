<?php

namespace Xoptov\TradingBot\Event;

use Xoptov\TradingBot\Model\AbstractTick;
use Xoptov\TradingBot\Model\CurrencyPair;

class Tick extends AbstractTick
{
    /** @var float */
    private $lowAskVolume;

    /** @var float */
    private $highBidVolume;

    /** @var float */
    private $low24h;

    /** @var float */
    private $high24h;

    /**
     * Tick constructor.
     * {@inheritdoc}
     * @param float $lowAskVolume
     * @param float $highBidVolume
     * @param float $low24h
     * @param float $high24h
     */
    public function __construct(CurrencyPair $currencyPair, $last, $lowAsk, $lowAskVolume, $highBid, $highBidVolume, $change, $baseVolume, $quoteVolume, $low24h, $high24h)
    {
        parent::__construct($currencyPair, $last, $lowAsk, $highBid, $baseVolume, $quoteVolume, $change);

        $this->lowAskVolume = $lowAskVolume;
        $this->highBidVolume = $highBidVolume;
        $this->low24h = $low24h;
        $this->high24h = $high24h;
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
    public function getHighBidVolume()
    {
        return $this->highBidVolume;
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