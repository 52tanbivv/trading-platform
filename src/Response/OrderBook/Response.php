<?php

namespace Xoptov\TradingBot\Response\OrderBook;

class Response
{
    /** @var Rate[] */
    private $asks = array();

    /** @var Rate[] */
    private $bids = array();

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
        return $this->asks;
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
        return $this->bids;
    }
}