<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Response\Ticker\Response as TickerResponse;
use Xoptov\TradingPlatform\Response\Balance\Response as BalanceResponse;
use Xoptov\TradingPlatform\Response\OrderBook\Response as OrderBookResponse;
use Xoptov\TradingPlatform\Response\Currencies\Response as CurrenciesResponse;
use Xoptov\TradingPlatform\Response\MarketData\Response as MarketDataResponse;
use Xoptov\TradingPlatform\Response\OpenOrders\Response as OpenOrdersResponse;
use Xoptov\TradingPlatform\Response\PlaceOrder\Response as PlaceOrderResponse;
use Xoptov\TradingPlatform\Response\TradeHistory\Response as TradeHistoryResponse;
use Xoptov\TradingPlatform\Response\CurrencyPairs\Response as CurrencyPairsResponse;

interface ConnectorInterface
{
    /**
     * @param callable $handler
     * @return CurrenciesResponse
     */
    public function getCurrencies(callable $handler);

    /**
     * @param callable $handler
     * @return CurrencyPairsResponse
     */
    public function getCurrencyPairs(callable $handler);

    /**
     * @param callable $handler
     * @return MarketDataResponse
     */
    public function getMarketData(callable $handler);

    /**
     * @param callable $handler
     * @return OrderBookResponse
     */
    public function getOrderBook(callable $handler);

    /**
     * @param callable $handler
     * @return TickerResponse
     */
    public function getTicker(callable $handler);

    /**
     * @param
     * @param callable $handler
     * @return TradeHistoryResponse
     */
    public function getTradeHistory(callable $handler);

    /**
     * @param Account $account
     * @param callable $handler
     * @return BalanceResponse
     */
    public function getBalance(Account $account, callable $handler);

    /**
     * @param Account $account
     * @param callable $handler
     * @return OpenOrdersResponse
     */
    public function getOpenOrders(Account $account, callable $handler);

    /**
     * @param Account $account
     * @param callable $handler
     * @return PlaceOrderResponse
     */
    public function placeOrder(Account $account, callable  $handler);
}