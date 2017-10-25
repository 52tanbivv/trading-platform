<?php

namespace Xoptov\TradingBot;

class OrderBook
{
    /** @var array */
    private $asks = array();

    /** @var array */
    private $bids = array();

    /**
     * @return array
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
     * @return array
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