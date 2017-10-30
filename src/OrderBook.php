<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Exception\UnknownTypeException;
use Xoptov\TradingPlatform\Model\Rate;
use Xoptov\TradingPlatform\Model\Order;

class OrderBook
{
    /** @var Rate[] */
    private $asks = array();

    /** @var Rate[] */
    private $bids = array();

    /**
     * @return Rate[]
     */
    public function getAsks()
    {
        $asks = array();

        foreach ($this->asks as $ask) {
            $asks[] = clone $ask;
        }

        return $asks;
    }

    /**
     * @return Rate[]
     */
    public function getBids()
    {
        $bids = array();

        foreach ($this->bids as $bid) {
            $bids[] = clone $bid;
        }

        return $bids;
    }

    /**
     * @param string $type
     * @param float $price
     * @param float $volume
     */
    public function add($type, $price, $volume)
    {
        $current = null;

        if ($type === Order::TYPE_ASK) {
            $current = $this->asks;
        } elseif ($type === Order::TYPE_BID) {
            $current = $this->bids;
        } else {
            throw new UnknownTypeException();
        }

        $rate = new Rate($price, $volume);
        $current[] = $rate;

        $this->resort($type, $current);
    }

    /**
     * @param string $type
     * @param float $price
     * @param float $volume
     */
    public function modify($type, $price, $volume)
    {
        $current = null;

        if ($type === Order::TYPE_ASK) {
            $current = $this->asks;
        } elseif ($type === Order::TYPE_BID) {
            $current = $this->bids;
        } else {
            throw new UnknownTypeException();
        }

        /** @var Rate $row */
        foreach ($current as $key => $row) {
            if ($row->getPrice() === $price) {
                unset($current[$key]);
                $this->add($type, $price, $volume);

                break;
            }
        }
    }

    /**
     * @param string $type
     * @param array $current
     * @return bool
     */
    public function resort($type, &$current)
    {
        $comparator = null;

        if ($type === Order::TYPE_ASK) {
            $comparator = function (Rate $item1, Rate $item2) {
                if ($item1->getPrice() > $item2->getPrice()) {
                    return 1;
                } elseif ($item2->getPrice() > $item1->getPrice()) {
                    return -1;
                } else {
                    return 0;
                }
            };
        } elseif ($type === Order::TYPE_BID) {
            $comparator = function (Rate $item1, Rate $item2) {
                if ($item1->getPrice() < $item2->getPrice()) {
                    return 1;
                } elseif ($item2->getPrice() < $item1->getPrice()) {
                    return -1;
                } else {
                    return 0;
                }
            };
        } else {
            throw new UnknownTypeException();
        }

        return usort($current, $comparator);
    }
}