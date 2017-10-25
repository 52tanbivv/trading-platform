<?php

namespace Xoptov\TradingBot\Strategy;

use Xoptov\TradingBot\TraderInterface;

interface StrategyInterface
{
    /**
     * @param TraderInterface $trader
     * @return array
     */
    public function createOrders(TraderInterface $trader);
}