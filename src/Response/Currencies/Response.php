<?php

namespace Xoptov\TradingPlatform\Response\Currencies;

class Response
{
	/** @var Currency[] */
	private $currencies = array();

	/**
	 * @return Currency[]
	 */
	public function getCurrencies()
	{
		$currencies = array();

		foreach ($this->currencies as $currency) {
			$currencies[] = clone $currency;
		}

		return $currencies;
	}

	public function addCurrency($symbol, $name, $enabled)
	{
		$currency = new Currency($symbol, $name, $enabled);

		return array_push($this->currencies, $currency);
	}
}