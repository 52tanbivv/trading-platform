<?php

namespace Xoptov\TradingBot\Strategy;

use Xoptov\TradingBot\TraderInterface;
use Xoptov\TradingBot\Model\Order;

interface StrategyInterface
{
    /**
     * @param TraderInterface $trader
     * @return Order[]
     */
    public function createOrders(TraderInterface $trader);
}