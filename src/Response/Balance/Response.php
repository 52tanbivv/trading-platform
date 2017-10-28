<?php

namespace Xoptov\TradingPlatform\Response\Balance;

use Xoptov\TradingPlatform\Model\Currency;
use Xoptov\TradingPlatform\Model\Active;

class Response
{
	/** @var Active[] */
	private $actives;

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

	/**
	 * @param Currency $currency
	 * @param float $volume
	 * @return int
	 */
	public function addActive(Currency $currency, $volume)
	{
		$active = new Active($currency, $volume);

		return array_push($this->actives, $active);
	}
}