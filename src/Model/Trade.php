<?php

namespace Xoptov\TradingBot\Model;

class Trade extends AbstractTrade
{
    /** @var Order */
    private $order;

    /**
     * Trade constructor.
     * @param Order $order
     * @param string $type
     * @param float $price
     * @param float $volume
     * @param \DateTime $createdAt;
     */
    public function __construct(Order $order, $type, $price, $volume, \DateTime $createdAt)
    {
        parent::__construct($type, $price, $volume, $createdAt);

        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        $order = clone $this->order;

        return $order;
    }
}