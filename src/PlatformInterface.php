<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Trader\TraderInterface;

interface PlatformInterface extends ConnectorInterface
{
    /**
     * @return boolean
     */
    public function start();

    /**
     * @param TraderInterface $trader
     * @return boolean
     */
    public function attach(TraderInterface $trader);
}