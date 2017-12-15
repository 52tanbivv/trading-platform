<?php

namespace Xoptov\TradingPlatform\Provider;

use DateTime;
use SplObserver;
use SplDoublyLinkedList;
use Xoptov\TradingCore\Model\Order;
use Xoptov\TradingCore\Model\Account;
use Xoptov\TradingCore\ConnectorInterface;
use Xoptov\TradingPlatform\Channel\PushChannel;
use Xoptov\TradingPlatform\Message\MessageInterface;
use Xoptov\TradingPlatform\Exception\QueryCountExceededException;
use Xoptov\TradingCore\Response\Ticker\Response as TickerResponse;
use Xoptov\TradingCore\Response\Balance\Response as BalanceResponse;
use Xoptov\TradingCore\Response\OrderBook\Response as OrderBookResponse;
use Xoptov\TradingCore\Response\Currencies\Response as CurrenciesResponse;
use Xoptov\TradingCore\Response\MarketData\Response as MarketDataResponse;
use Xoptov\TradingCore\Response\OpenOrders\Response as OpenOrdersResponse;
use Xoptov\TradingCore\Response\PlaceOrder\Response as PlaceOrderResponse;
use Xoptov\TradingCore\Response\TradeHistory\Response as TradeHistoryResponse;
use Xoptov\TradingCore\Response\CurrencyPairs\Response as CurrencyPairsResponse;

/**
 * @method CurrenciesResponse currencies()
 * @method CurrencyPairsResponse currencyPairs(SplDoublyLinkedList $currencies)
 * @method MarketDataResponse marketData()
 * @method TickerResponse ticker()
 * @method TradeHistoryResponse tradeHistory()
 * @method OrderBookResponse orderBook()
 * @method BalanceResponse balance(Account $account)
 * @method OpenOrdersResponse openOrders(Account $account)
 * @method PlaceOrderResponse placeOrder(Order $order, Account $account)
 * @method bool cancelOrder(int $orderId, Account $account)
 */
abstract class AbstractProvider implements ProviderInterface
{
    /** @var bool */
    private $started = false;

	/** @var int Limit requests per second. */
	private $rps;

	/** @var array */
	protected $supportChannels = array(
		MessageInterface::TYPE_TICKER,
		MessageInterface::TYPE_ORDER_BOOK,
		MessageInterface::TYPE_TRADE
	);

	/** @var SplDoublyLinkedList */
	private $channels;

	/** @var ConnectorInterface */
	private $connector;

	/** @var DateTime Time of last request. */
	private $lastRequestAt;

	/** @var int Requests counter for tracking limit. */
	private $requestCounter = 0;

	/**
	 * AbstractProvider constructor.
	 * @param ConnectorInterface $connector
	 * @param array $options
	 */
	public function __construct(ConnectorInterface $connector, array $options)
	{
		$this->channels = $this->createChannels();
		$this->connector = $connector;
		$this->rps = $options["rps"];
	}

    /**
     * {@inheritdoc}
     */
	public function isStarted()
    {
        return $this->started;
    }

    /**
	 * {@inheritdoc}
	 */
	public function bindChannel($type, SplObserver $observer)
	{
		/** @var PushChannel $channel */
		foreach ($this->channels as $channel) {
			if ($channel->getType() === $type) {
				$channel->attach($observer);
			}
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSupportChannels()
	{
		return $this->supportChannels;
	}

	public function start()
    {
        // Vary important check.
        if ($this->started) {
            return;
        }
    }

    /**
	 * {@inheritdoc}
	 */
	public function __call($name, $arguments)
	{
		if (!$this->checkRequestsLimit()) {
			throw new QueryCountExceededException("Too many requests per second.");
		}

		$method = "request" . $name;

		if (method_exists($this->connector, $method)) {
            $response = call_user_func(array($this->connector, ), $arguments);

            if ($response) {
                $this->countingRequests();

                return $response;
            }
        }

		return null;
	}

	/**
	 * @param int $type
	 * @param MessageInterface $message
	 */
	protected function propagate($type, MessageInterface $message)
	{
		/** @var PushChannel $channel */
		foreach ($this->channels as $channel) {
			if ($channel->getType() === $type) {
				$channel->setMessage($message)->notify();
			}
		}
	}

	/**
	 * @return SplDoublyLinkedList
	 */
	private function createChannels()
	{
		$channels = new SplDoublyLinkedList();

		foreach ($this->supportChannels as $type) {
			$channels->push(new PushChannel($type));
		}

		return $channels;
	}

	/**
	 * This method must be invoke
	 */
	private function countingRequests()
	{
		$now = new DateTime();

		if (empty($this->lastRequestAt)) {
			$this->lastRequestAt = $now;
		}

		if ($now->getTimestamp() === $this->lastRequestAt->getTimestamp()) {
			$this->requestCounter++;
		} else {
			$this->lastRequestAt = $now;
			$this->requestCounter = 0;
		}
	}

	/**
	 * @return bool
	 */
	private function checkRequestsLimit()
	{
		return empty($this->lastRequestAt) || $this->requestCounter < $this->rps;
	}
}