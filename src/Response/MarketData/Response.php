<?php

namespace Xoptov\TradingPlatform\Response\MarketData;

class Response
{
    /** @var Data[] */
    private $data = array();

    /**
     * @return Data[]
     */
    public function getData()
    {
    	$items = array();

    	foreach ($this->data as $item) {
    		$items[] = clone $item;
	    }

        return $items;
    }

    /**
     * @param float $open
     * @param float $close
     * @param float $high
     * @param float $low
     * @param \DatePeriod $period
     * @param float $baseVolume
     * @param float $quoteVolume
     * @param float $weightedAverage
     * @return int
     */
    public function addDataItem($open, $close, $high, $low, \DatePeriod $period, $baseVolume, $quoteVolume, $weightedAverage)
    {
        $item = new Data($open, $close, $high, $low, $period, $baseVolume, $quoteVolume, $weightedAverage);

        return array_push($this->data, $item);
    }
}