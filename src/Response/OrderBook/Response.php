<?php

namespace Xoptov\TradingBot\Response\OrderBook;

class Response
{
    /** @var Rate[] */
    private $asks;

    /** @var Rate[] */
    private $bids;

    /**
     * @param float $price
     * @param float $value
     * @return int
     */
    public function addAsk($price, $value)
    {
        $rate = new Rate($price, $value);

        return array_push($this->asks, $rate);
    }

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
     * @param float $price
     * @param float $value
     * @return int
     */
    public function addBid($price, $value)
    {
        $rate = new Rate($price, $value);

        return array_push($this->bids, $rate);
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