<?php

namespace Xoptov\TradingBot\Response\CurrencyPairs;

use Xoptov\TradingBot\Model\Currency;
use Xoptov\TradingBot\Model\CurrencyPair;

class Response
{
	/** @var CurrencyPair[] */
	private $currencyPairs = array();

	/**
	 * @return CurrencyPair[]
	 */
	public function getCurrencyPairs()
	{
		return $this->currencyPairs;
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