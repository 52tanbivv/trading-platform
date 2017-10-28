<?php

namespace Xoptov\TradingPlatform\Provider;

use Xoptov\TradingPlatform\PlatformInterface;
use Xoptov\TradingPlatform\Response\Balance\Response as BalanceResponse;
use Xoptov\TradingPlatform\Response\Currencies\Response as CurrenciesResponse;
use Xoptov\TradingPlatform\Response\CurrencyPairs\Response as CurrencyPairsResponse;
use Xoptov\TradingPlatform\Response\MarketData\Response as MarketDataResponse;
use Xoptov\TradingPlatform\Response\OpenOrders\Response as OpenOrdersResponse;
use Xoptov\TradingPlatform\Response\OrderBook\Response as OrderBookResponse;
use Xoptov\TradingPlatform\Response\PlaceOrder\Response as PlaceOrderResponse;
use Xoptov\TradingPlatform\Response\Ticker\Response as TickerResponse;
use Xoptov\TradingPlatform\Response\TradeHistory\Response as TradeHistoryResponse;

interface ProviderInterface
{
    /**
     * @param PlatformInterface $platform
     * @return void
     */
    public function bind(PlatformInterface $platform);

    /**
     * @return void
     * @todo: This method need refactoring for event loop setting.
     */
    public function start();

	/**
	 * @return string
	 */
    public function getName();

	/**
	 * @return BalanceResponse
	 */
    public function getBalance();

	/**
	 * @return CurrenciesResponse
	 */
    public function getCurrencies();

	/**
	 * @return CurrencyPairsResponse
	 */
    public function getCurrencyPairs();

	/**
	 * @return MarketDataResponse
	 */
    public function getMarketData();

	/**
	 * @return OpenOrdersResponse
	 */
    public function getOpenOrders();

	/**
	 * @return OrderBookResponse
	 */
    public function getOrderBook();

	/**
	 * @return PlaceOrderResponse
	 */
    public function placeOrder();

	/**
	 * @return boolean
	 */
    public function cancelOrder();

	/**
	 * @return TickerResponse
	 */
    public function getTicker();

	/**
	 * @return TradeHistoryResponse
	 */
    public function getTradeHistory();
}