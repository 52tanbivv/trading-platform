<?php

namespace Xoptov\TradingPlatform\Provider;

use Xoptov\TradingPlatform\OrderBook;
use Xoptov\TradingPlatform\Model\Currency;
use Xoptov\TradingPlatform\Model\CurrencyPair;
use Xoptov\TradingPlatform\ConnectorInterface;

abstract class AbstractProvider implements ProviderInterface, ConnectorInterface
{
    /** @var OrderBook */
    private $orderBook;

	/** @var Currency[] */
	private $currencies = array();

	/** @var CurrencyPair[] */
	private $currencyPairs = array();

    /**
     * AbstractProvider constructor.
     */
	public function __construct()
    {
        $this->orderBook = new OrderBook();
    }
}