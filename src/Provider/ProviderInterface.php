<?php

namespace Xoptov\TradingBot\Provider;

use Xoptov\TradingBot\Model\Order;
use Xoptov\TradingBot\Model\CurrencyPair;
use Xoptov\TradingBot\Response\OrdersResponse;
use Xoptov\TradingBot\Response\BalanceResponse;
use Xoptov\TradingBot\Response\BookResponse;
use Xoptov\TradingBot\Response\CurrenciesResponse;
use Xoptov\TradingBot\Response\CurrencyPairsResponse;
use Xoptov\TradingBot\Response\PlaceOrderResponse;
use Xoptov\TradingBot\Response\CancelOrderResponse;
use Xoptov\TradingBot\Response\TradeHistoryResponse;

//TODO: need fix after creating all response classes.
interface ProviderInterface
{
    const CHANNEL_TICKER = 1;
    const CHANNEL_BOOK = 2;
    const CHANNEL_TRADE = 4;

    /**
     * @param HandlerInterface $handler
     * @param int $channel
     * @return mixed
     */
    public function bind(HandlerInterface $handler, $channel = self::CHANNEL_TICKER);

    /**
     * @return void
     */
    public function start();

    /**
     * @param Order $order
     * @return PlaceOrderResponse
     */
    public function placeOrder(Order $order);

    /**
     * @param Order $order
     * @return CancelOrderResponse
     */
    public function cancelOrder(Order $order);

    /**
     * @return BalanceResponse
     */
    public function getBalance();

    /**
     * @return OrdersResponse
     */
    public function getOrders();

    /**
     * @return TradeHistoryResponse
     */
    public function getTradeHistory();

    /**
     * @return BookResponse;
     */
    public function getBook();

    /**
     * @return CurrenciesResponse
     */
    public function getCurrencies();

    /**
     * @return CurrencyPairsResponse
     */
    public function getCurrencyPairs();

    /**
     * @param string $symbol
     * @return CurrencyPair
     */
    public function createCurrencyPair($symbol);
}