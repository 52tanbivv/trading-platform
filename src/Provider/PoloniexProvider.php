<?php

namespace Xoptov\TradingPlatform\Provider;

use SplDoublyLinkedList;
use Xoptov\TradingPlatform\Account;
use Xoptov\TradingPlatform\Model\Order;
use Xoptov\TradingPlatform\Response\Currencies\Response as CurrenciesResponse;
use Xoptov\TradingPlatform\Response\CurrencyPairs\Response as CurrencyPairResponse;

class PoloniexProvider extends AbstractProvider
{
	/**
	 * {@inheritdoc}
	 */
    protected function requestCurrencies()
    {
        $response = $this->httpClient->get("public", array(
            "query" => array("command" => "returnCurrencies")
        ));

        if ($response->getStatusCode() === 200) {
            $json = json_decode($response->getBody());

            if (empty($json)) {
            	return null;
            }

            $response = new CurrenciesResponse();

            foreach ($json as $symbol => $description) {
            	if ($description->disabled == 0 && $description->delisted == 0 && $description->frozen == 0) {
            		$enabled = true;
	            } else {
            		$enabled = false;
	            }

            	$response->addCurrency($symbol, $description->name, $enabled);
            }

            return $response;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    protected function requestCurrencyPair(SplDoublyLinkedList $currencies)
    {
        $response = $this->httpClient->get("public", array(
            "query" => array("command" => "return24hVolume")
        ));

        if ($response->getStatusCode() === 200) {
            $json = json_decode($response->getBody(), true);

            if (empty($json)) {
                return null;
            }

            $response = new CurrencyPairResponse();

            foreach ($json as $pairData) {
                $symbols = array_keys($pairData);

            }

            return $response;
        }

        return null;
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