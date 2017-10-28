<?php

namespace Xoptov\TradingPlatform\Response\TradeHistory;

use Xoptov\TradingPlatform\Model\Trade;

class Response
{
    /** @var Trade[] */
    private $trades = array();

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
     * @param mixed $id
     * @param string $type
     * @param float $price
     * @param float $volume
     * @param \DateTime $createdAt
     * @return int
     */
    public function addTrade($id, $type, $price, $volume, \DateTime $createdAt)
    {
        $trade = new Trade($id, $type, $price, $volume, $createdAt);

        return array_push($this->trades, $trade);
    }
}