<?php

namespace Xoptov\TradingPlatform\Response\OrderBook;

use Xoptov\TradingPlatform\Model\Rate;

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