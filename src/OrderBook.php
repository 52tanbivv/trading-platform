<?php

namespace Xoptov\TradingPlatform;

use Ds\Map;
use Xoptov\TradingPlatform\Model\Rate;
use Xoptov\TradingPlatform\Model\Order;
use Xoptov\TradingPlatform\Exception\UnknownTypeException;
use Xoptov\TradingPlatform\Exception\InvalidOrderBookException;

class OrderBook
{
    /** @var Map */
    private $asks;

    /** @var Map */
    private $bids = array();

	/**
	 * OrderBook constructor.
	 */
    public function __construct()
    {
    	$this->asks = new Map();
    	$this->bids = new Map();
    }

	/**
     * @return Map
     */
    public function getAsks()
    {
        $asks = clone $this->asks;

        return $asks;
    }

    /**
     * @return Map
     */
    public function getBids()
    {
        $bids = clone $this->bids;

        return $bids;
    }

	/**
	 * @return Rate|null
	 */
    public function getHighestBid()
    {
		$pair = clone $this->bids->first();

		if ($pair) {
			$bid = clone $pair["value"];

			return $bid;
		}

		return null;
    }

	/**
	 * @return Rate|null
	 */
    public function getLowestAsk()
    {
		$pair = clone $this->asks->first();

		if ($pair) {
			$ask = clone $pair["value"];

			return $ask;
		}

		return null;
    }

    /**
     * @param string $type
     * @param Rate $rate
     * @return boolean
     */
    public function add($type, Rate $rate)
    {
        $side = $this->determineSide($type);

        if ($side->hasKey($rate->getPrice())) {
        	throw new InvalidOrderBookException();
        }

        $side->put($rate->getPrice(), $rate);
        $this->resort($type, $side);

        return true;
    }

    /**
     * @param string $type
     * @param Rate $rate
     * @return boolean
     */
    public function modify($type, Rate $rate)
    {
        $side = $this->determineSide($type);

		if (!$side->hasKey($rate->getPrice())) {
        	throw new InvalidOrderBookException();
		}

		/** @var Rate $item */
		$item = $side->get($rate->getPrice());
        $item->setVolume($rate->getVolume());

        return true;
    }

	/**
	 * @param $type
	 * @return Map
	 */
    private function determineSide($type)
    {
    	if (Order::TYPE_ASK === $type) {
    		return $this->asks;
	    } elseif (Order::TYPE_BID === $type) {
    		return $this->bids;
        }

        throw new UnknownTypeException();
    }

    /**
     * @param string $type
     * @param Map $current
     */
    private function resort($type, Map $current)
    {
        $comparator = null;

        if ($type === Order::TYPE_ASK) {
            $comparator = function ($price1, $price2) {
                if ($price1 > $price2) {
                    return 1;
                } elseif ($price2 > $price1) {
                    return -1;
                } else {
                    return 0;
                }
            };
        } elseif ($type === Order::TYPE_BID) {
            $comparator = function ($price1, $price2) {
                if ($price1 < $price2) {
                    return 1;
                } elseif ($price2 < $price1) {
                    return -1;
                } else {
                    return 0;
                }
            };
        } else {
            throw new UnknownTypeException();
        }

        $current->ksort($comparator);
    }
}