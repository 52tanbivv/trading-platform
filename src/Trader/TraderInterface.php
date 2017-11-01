<?php

namespace Xoptov\TradingPlatform\Trader;

use SplObserver;

interface TraderInterface extends SplObserver
{
    /**
     * @param int $type
     * @return boolean
     */
    public function isSupportMessage($type);
}