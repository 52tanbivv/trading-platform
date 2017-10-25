<?php

namespace Xoptov\TradingBot;

use Xoptov\TradingBot\Model\Active;

class Balance
{
    /** @var Active[] */
    private $actives = array();

    /**
     * @return Active[]
     */
    public function getActives()
    {
        $actives = array();

        foreach ($this->actives as $active) {
            $actives[] = clone $active;
        }

        return $actives;
    }
}