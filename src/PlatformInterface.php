<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Trader\TraderInterface;
use Xoptov\TradingPlatform\Model\Order;

interface PlatformInterface
{
    /**
     * @return boolean
     */
    public function start();

    /**
     * @param TraderInterface $trader
     * @return boolean
     */
    public function attach(TraderInterface $trader);

    /**
     * @param callable $handler
     */
    public function getCurrencies(callable $handler);

    /**
     * @param callable $handler
     */
    public function getCurrencyPairs(callable $handler);

    /**
     * @param callable $handler
     */
    public function getChart(callable $handler);

    /**
     * @param callable $handler
     */
    public function getOrderBook(callable $handler);

    /**
     * @param callable $handler
     */
    public function getTicker(callable $handler);

    /**
     * @param callable $handler
     */
    public function getTradeHistory(callable $handler);

    /**
     * @param Account $account
     * @param callable $handler
     */
    public function getBalance(Account $account, callable $handler);

    /**
     * @param Account $account
     * @param callable $handler
     */
    public function getOpenOrders(Account $account, callable $handler);

    /**
     * @param Account $account
     * @param callable $handler
     */
    public function placeOrder(Account $account, callable  $handler);

    /**
     * @param Account $account
     * @param Order $order
     * @param callable $handler
     */
    public function cancelOrder(Account $account, Order $order, callable $handler);
}