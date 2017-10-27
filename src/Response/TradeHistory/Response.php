<?php

namespace Xoptov\TradingBot\Response\TradeHistory;

class Response
{
    /** @var Trade[] */
    private $trades;

    /**
     * @return Trade[]
     */
    public function getTrades()
    {
        $trades = array();

        foreach ($this->trades as $trade) {
            $trades[] = clone $trade;
        }

        return $trades;
    }

    /**
     * @param string $type
     * @param float $price
     * @param float $volume
     * @param \DateTime $createdAt
     * @return int
     */
    public function addTrade($type, $price, $volume, \DateTime $createdAt)
    {
        $trade = new Trade($type, $price, $volume, $createdAt);

        return array_push($this->trades, $trade);
    }
}