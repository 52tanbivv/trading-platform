<?php

namespace Xoptov\TradingPlatform\Response\CurrencyPairs;

use Xoptov\TradingPlatform\Model\Currency;
use Xoptov\TradingPlatform\Model\CurrencyPair;

class Response
{
	/** @var CurrencyPair[] */
	private $currencyPairs = array();

	/**
	 * @return CurrencyPair[]
	 */
	public function getCurrencyPairs()
	{
		$currencyPairs = array();

		foreach ($this->currencyPairs as $currencyPair) {
			$currencyPairs[] = clone $currencyPair;
		}

		return $currencyPairs;
	}

	/**
	 * @param Currency $base
	 * @param Currency $quote
	 * @return int
	 */
	public function addCurrencyPair(Currency $base, Currency $quote)
	{
		$currencyPair = new CurrencyPair($base, $quote);

		return array_push($this->currencyPairs, $currencyPair);
	}
}