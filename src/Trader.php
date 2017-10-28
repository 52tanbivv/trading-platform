<?php

namespace Xoptov\TradingBot;

use Xoptov\TradingBot\Chart\Chart;
use Xoptov\TradingBot\Model\Order;
use Xoptov\TradingBot\Event\Tick as TickEvent;
use Xoptov\TradingBot\Event\Trade as TradeEvent;
use Xoptov\TradingBot\Provider\HandlerInterface;
use Xoptov\TradingBot\Provider\ProviderInterface;
use Xoptov\TradingBot\Event\OrderBook as OrderBookEvent;

class Trader implements TraderInterface, HandlerInterface
{
    /** @var ProviderInterface */
    private $connector;

    /** @var OrderBook */
    private $orderBook;

    /** @var Order[] */
    private $orders = array(); // Свои ордера.

    /** @var Chart */
    private $chart;

    /** @var Balance */
    private $balance;

    /**
     * Trader constructor.
     * @param ProviderInterface $connector
     */
    public function __construct(ProviderInterface $connector)
    {
        $this->connector = $connector;
    }

    /**
     * {@inheritdoc}
     */
    public function getAsks()
    {
        return $this->orderBook->getAsks();
    }

    /**
     * {@inheritdoc}
     */
    public function getBids()
    {
        return $this->orderBook->getBids();
    }

    /**
     * {@inheritdoc}
     */
    public function getActives()
    {
        return $this->balance->getActives();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrders()
    {
        $orders = array();

        foreach ($this->orders as $order) {
            $orders[] = clone $order;
        }

        return $orders;
    }

    /**
     * {@inheritdoc}
     */
    public function getChart()
    {
        $chart = clone $this->chart;

        return $chart;
    }

    /**
     * {@inheritdoc}
     */
    public function handleTick(TickEvent $event)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function handleOrderBook(OrderBookEvent $event)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function handleTrade(TradeEvent $event)
    {

    }
}