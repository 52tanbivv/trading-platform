<?php

namespace Xoptov\TradingPlatform\Channel;

use \SplObserver;
use \SplSubject;

class OrderBook implements SplSubject
{
    /** @var SplObserver[] */
    private $observers;

    public function attach(SplObserver $observer)
    {

    }

    public function detach(SplObserver $observer)
    {

    }

    public function notify()
    {

    }
}