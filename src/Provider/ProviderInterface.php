<?php

namespace Xoptov\TradingPlatform\Provider;

use SplObserver;
use Xoptov\TradingPlatform\Account;
use Xoptov\TradingPlatform\Model\Order;
use Xoptov\TradingPlatform\Response\Ticker\Response as TickerResponse;
use Xoptov\TradingPlatform\Response\Balance\Response as BalanceResponse;
use Xoptov\TradingPlatform\Response\OrderBook\Response as OrderBookResponse;
use Xoptov\TradingPlatform\Response\Currencies\Response as CurrenciesResponse;
use Xoptov\TradingPlatform\Response\MarketData\Response as MarketDataResponse;
use Xoptov\TradingPlatform\Response\OpenOrders\Response as OpenOrdersResponse;
use Xoptov\TradingPlatform\Response\TradeHistory\Response as TradeHistoryResponse;
use Xoptov\TradingPlatform\Response\CurrencyPairs\Response as CurrencyPairsResponse;
use Xoptov\TradingPlatform\Response\PlaceOrder\Response as PlaceOrderResponse;

interface ProviderInterface
{
    /**
     * @return void
     */
    public function start();

    /**
     * @param SplObserver $observer
     * @return boolean
     */
    public function bindChannel(SplObserver $observer);

	/**
	 * @param SplObserver $observer
	 */
    public function bindAllChannels(SplObserver $observer);

    /**
     * @return CurrenciesResponse
     */
    public function currencies();

    /**
     * @return CurrencyPairsResponse
     */
    public function currencyPairs();

    /**
     * @return MarketDataResponse
     */
    public function marketData();

    /**
     * @return TickerResponse
     */
    public function ticker();

    /**
     * @return TradeHistoryResponse
     */
    public function tradeHistory();

    /**
     * @param Account $account
     * @return BalanceResponse
     */
    public function balance(Account $account);

    /**
     * @param Account $account
     * @return OpenOrdersResponse
     */
    public function openOrders(Account $account);

    /**
     * @param Account $account
     * @return OrderBookResponse
     */
    public function orderBook(Account $account);

    /**
     * @param Account $account
     * @param Order $order
     * @return PlaceOrderResponse
     */
    public function placeOrder(Account $account, Order $order);

    /**
     * @param Account $account
     * @param Order $order
     * @return boolean
     */
    public function cancelOrder(Account $account, Order $order);
}