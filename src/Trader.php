<?php

namespace Xoptov\TradingBot;

use Xoptov\TradingBot\Connector\ConnectorInterface;
use Xoptov\TradingBot\Connector\HandlerInterface;
use Xoptov\TradingBot\Chart\Chart;
use Xoptov\TradingBot\Model\Order;

class Trader implements TraderInterface, HandlerInterface
{
    /** @var ConnectorInterface */
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
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    public function onTick(array $data)
    {

    }

    public function onBook(array $data)
    {

    }

    public function onTrade(array $data)
    {

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
    public function getChart()
    {
        $chart = clone $this->chart;

        return $chart;
    }
}