<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Model\Rate;

class OrderBook
{
    /** @var Rate[] */
    private $asks = array();

    /** @var Rate[] */
    private $bids = array();

    /**
     * @return Rate[]
     */
    public function getAsks()
    {
        $asks = array();

        foreach ($this->asks as $ask) {
            $asks[] = clone $ask;
        }

        return $asks;
    }

    /**
     * @return Rate[]
     */
    public function getBids()
    {
        $bids = array();

        foreach ($this->bids as $bid) {
            $bids[] = clone $bid;
        }

        return $bids;
    }
}