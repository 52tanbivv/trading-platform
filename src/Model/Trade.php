<?php

namespace Xoptov\TradingBot\Model;

class Trade
{
    const TYPE_BUY = "buy";
    const TYPE_SELL = "sell";

    /** @var Order */
    private $order;

    /** @var string */
    private $type;

    /** @var float */
    private $rate;

    /** @var float */
    private $volume;

    /**
     * Trade constructor.
     * @param Order $order
     * @param string $type
     * @param float $rate
     * @param float $volume
     */
    public function __construct(Order $order, $type, $rate, $volume)
    {
        $this->order = $order;
        $this->type = $type;
        $this->rate = $rate;
        $this->volume = $volume;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        $order = clone $this->order;

        return $order;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
}