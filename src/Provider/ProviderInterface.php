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
use Xoptov\TradingPlatform\Response\PlaceOrder\Response as PlaceOrderResponse;
use Xoptov\TradingPlatform\Response\TradeHistory\Response as TradeHistoryResponse;
use Xoptov\TradingPlatform\Response\CurrencyPairs\Response as CurrencyPairsResponse;

/**
 * @method CurrenciesResponse currencies()
 * @method CurrencyPairsResponse currencyPairs()
 * @method MarketDataResponse marketData()
 * @method TickerResponse ticker()
 * @method TradeHistoryResponse tradeHistory()
 * @method OrderBookResponse orderBook()
 * @method BalanceResponse balance(Account $account)
 * @method OpenOrdersResponse openOrders(Account $account)
 * @method PlaceOrderResponse placeOrder(Order $order, Account $account)
 * @method bool cancelOrder(int $orderId, Account $account)
 */
interface ProviderInterface
{
    /**
     * @return void
     */
    public function start();

    /**
     * @param int $type
     * @param SplObserver $observer
     */
    public function bindChannel($type, SplObserver $observer);

	/**
	 * @return array
	 */
    public function getSupportChannels();

	/**
	 * @param string $name
	 * @param string $arguments
	 * @return mixed
	 */
    public function __call($name, $arguments);

    /**
     * @return boolean
     */
    public function isStarted();
}