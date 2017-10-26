<?php

namespace Xoptov\TradingBot;

use Xoptov\TradingBot\Provider\ProviderInterface;
use Xoptov\TradingBot\Provider\HandlerInterface;
use Xoptov\TradingBot\Chart\Chart;
use Xoptov\TradingBot\Model\Order;

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
    public function getAskOrders()
    {
        return $this->orderBook->getAsks();
    }

    /**
     * {@inheritdoc}
     */
    public function getBidOrders()
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
    public function onTick(array $data)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function onBook(array $data)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function onTrade(array $data)
    {

    }
}