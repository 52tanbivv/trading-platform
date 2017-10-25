<?php

namespace Xoptov\TradingBot\Connector;

use Xoptov\TradingBot\Model\Order;

interface ConnectorInterface
{
    public function bind(HandlerInterface $handler);

    public function placeOrder(Order $order);

    public function cancelOrder(Order $order);

    public function getBalance();

    public function getOrders();

    public function getTradeHistory();

    public function getOrderBook();

    public function getCurrencies();
}