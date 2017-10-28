<?php

namespace Xoptov\TradingBot\Model;

class Trade implements TradeInterface
{
    use RateTrait;

    use TimeTrackingTrait;

    /** @var string */
    private $type;

    /**
     * AbstractTrade constructor.
     * @param string $type
     * @param string $price
     * @param string $volume
     * @param \DateTime $createdAt
     */
    public function __construct($type, $price, $volume, \DateTime $createdAt)
    {
        $this->type = $type;
        $this->price = $price;
        $this->volume = $volume;
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }
}