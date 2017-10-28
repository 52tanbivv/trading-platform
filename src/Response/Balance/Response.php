<?php

namespace Xoptov\TradingBot\Response\Balance;

use Xoptov\TradingBot\Model\Currency;

class Response
{
	/** @var Active[] */
	private $actives = array();

	/**
	 * @return Active[]
	 */
	public function getActives()
	{
		return $this->actives;
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