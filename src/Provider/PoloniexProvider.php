<?php

namespace Xoptov\TradingPlatform\Provider;

use Xoptov\TradingPlatform\Account;
use Xoptov\TradingPlatform\Model\Order;

class PoloniexProvider extends AbstractProvider
{
    protected function requestCurrencies()
    {
        $response = $this->httpClient->get("public", array(
            "query" => array("command" => "returnCurrencies")
        ));

        if ($response->getStatusCode() === 200) {
            xdebug_break();
        }
    }

    protected function requestCurrencyPair()
    {
        // TODO: Implement requestCurrencyPair() method.
    }

    protected function requestMarketData()
    {
        // TODO: Implement requestMarketData() method.
    }

    protected function requestOrderBook()
    {
        // TODO: Implement requestOrderBook() method.
    }

    protected function requestTicker()
    {
        // TODO: Implement requestTicker() method.
    }

    protected function requestTradeHistory()
    {
        // TODO: Implement requestTradeHistory() method.
    }

    protected function requestBalance(Account $account)
    {
        // TODO: Implement requestBalance() method.
    }

    protected function requestOpenOrders(Account $account)
    {
        // TODO: Implement requestOpenOrders() method.
    }

    protected function requestPlaceOrder(Order $order, Account $account)
    {
        // TODO: Implement requestPlaceOrder() method.
    }

    protected function requestCancelOrder($orderId, Account $account)
    {
        // TODO: Implement requestCancelOrder() method.
    }
}