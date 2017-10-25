<?php

namespace Xoptov\TradingBot\Model;

use Xoptov\TradingBot\Exception\UnknownTypeException;

class Active
{
    /** @var Currency */
    private $currency;

    /** @var float */
    private $rate;

    /** @var float */
    private $volume = 0;

    /** @var float */
    private $total = 0;

    /** @var Trade[] */
    private $trades;

    /** @var \DateTime */
    private $createdAt;

    /**
     * Active constructor.
     * @param Currency $currency
     * @param int $volume
     */
    public function __construct(Currency $currency, $volume = 0)
    {
        $this->currency = $currency;
        $this->volume = $volume;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        $currency = clone $this->currency;

        return $currency;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        $createdAt = clone $this->createdAt;

        return $createdAt;
    }

    /**
     * @param Trade $trade
     */
    public function addTrade(Trade $trade)
    {
        array_push($this->trades, $trade);

        if ($trade->getType() === Trade::TYPE_SELL) {
            $this->volume -= $trade->getVolume();
        } elseif ($trade->getType() === Trade::TYPE_BUY) {
            $this->volume += $trade->getVolume();

            $totals = array_map(function(Trade $trade) {
                return array(
                    "rate" => $trade->getRate(),
                    "volume" => $trade->getVolume()
                );
            }, $this->trades);

            $rates = array_sum(array_column($totals, "rate"));
            $volumes = array_sum(array_column($totals, "volume"));

            $this->rate = $rates / $volumes;
        } else {
            throw new UnknownTypeException("Trade type must be set.");
        }
    }

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
}