<?php

namespace Xoptov\TradingPlatform\Provider;

use DateTime;
use SplObserver;
use GuzzleHttp\Client;
use SplDoublyLinkedList;
use GuzzleHttp\ClientInterface;
use Xoptov\TradingPlatform\Account;
use Xoptov\TradingPlatform\Model\Order;
use Xoptov\TradingPlatform\Channel\PushChannel;
use Xoptov\TradingPlatform\Message\MessageInterface;
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
abstract class AbstractProvider implements ProviderInterface
{
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

	/** @var ClientInterface */
	private $httpClient;

	/** @var DateTime Time of last request. */
	private $lastRequestAt;

	/** @var int Requests counter for tracking limit. */
	private $requestCounter = 0;

	/**
	 * AbstractProvider constructor.
	 * @param array $httpOptions
	 * @param int $rps
	 */
	public function __construct(array $httpOptions, $rps)
	{
		$this->channels = $this->createChannels();
		$this->httpClient = new Client($httpOptions);
		$this->rps = $rps;
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

	/**
	 * {@inheritdoc}
	 */
	public function __call($name, $arguments)
	{
		if (!$this->checkRequestsLimit()) {
			return null;
		}

		$response = call_user_func(array($this, "request" . $name), $arguments);
		$this->countingRequests();

		return $response;
	}

	/**
	 * @return CurrenciesResponse
	 */
	abstract protected function requestCurrencies();

	/**
	 * @return CurrencyPairsResponse
	 */
	abstract protected function requestCurrencyPair();

	/**
	 * @return MarketDataResponse
	 */
	abstract protected function requestMarketData();

	/**
	 * @return TickerResponse
	 */
	abstract protected function requestTicker();

	/**
	 * @return TradeHistoryResponse
	 */
	abstract protected function requestTradeHistory();

	/**
	 * @return OrderBookResponse
	 */
	abstract protected function requestOrderBook();

	/**
	 * @param Account $account
	 * @return BalanceResponse
	 */
	abstract protected function requestBalance(Account $account);

	/**
	 * @param Account $account
	 * @return OpenOrdersResponse
	 */
	abstract protected function requestOpenOrders(Account $account);

	/**
	 * @param Order $order
	 * @param Account $account
	 * @return PlaceOrderResponse
	 */
	abstract protected function requestPlaceOrder(Order $order, Account $account);

	/**
	 * @param int $orderId
	 * @param Account $account
	 * @return bool
	 */
	abstract protected function requestCancelOrder($orderId, Account $account);

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