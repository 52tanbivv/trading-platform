<?php

namespace Xoptov\TradingPlatform\Trader;

interface TraderInterface extends \SplObserver
{
    /**
     * @param int $type
     * @return boolean
     */
    public function isSupportMessage($type);
}