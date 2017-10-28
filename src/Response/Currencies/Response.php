<?php

namespace Xoptov\TradingBot\Response\Currencies;

class Response
{
	/** @var Currency[] */
	private $currencies = array();

	/**
	 * @return mixed
	 */
	public function getCurrencies()
	{
		return $this->currencies;
	}

	public function addCurrency($symbol, $name, $enabled)
	{
		$currency = new Currency($symbol, $name, $enabled);

		return array_push($this->currencies, $currency);
	}
}