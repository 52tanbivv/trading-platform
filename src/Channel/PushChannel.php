<?php

namespace Xoptov\TradingPlatform\Channel;

use SplSubject;
use SplObserver;
use SplDoublyLinkedList;
use Xoptov\TradingPlatform\Message\MessageInterface;

class PushChannel implements SplSubject
{
	/** @var int */
	private $type;

	/** @var SplDoublyLinkedList */
    private $observers;

	/** @var MessageInterface */
    private $message;

	/**
	 * PushChannel constructor.
	 * @param int $type
	 */
    public function __construct($type)
    {
	    $this->type = $type;
	    $this->observers = new SplDoublyLinkedList();
    }

	/**
	 * {@inheritdoc}
	 * @return bool
	 */
    public function attach(SplObserver $observer)
    {
		foreach ($this->observers as $attached) {
			if ($attached === $observer) {
				return false;
			}
		}

		$this->observers->push($observer);

		return true;
    }

	/**
	 * {@inheritdoc}
	 * @return bool
	 */
    public function detach(SplObserver $observer)
    {
		foreach ($this->observers as $key => $attached) {
			if ($attached === $observer) {
				$this->observers->offsetUnset($key);

				return true;
			}
		}

		return false;
    }

	/**
	 * {@inheritdoc}
	 */
    public function notify()
    {
    	if (empty($this->message)) {
    		return;
	    }

    	/** @var \SplObserver $observer */
	    foreach ($this->observers as $observer) {
			$observer->update($this);
		}
    }

	/**
	 * @param MessageInterface $message
	 * @return PushChannel
	 */
    public function setMessage(MessageInterface $message)
    {
    	$this->message = $message;

    	return $this;
    }

	/**
	 * @return int
	 */
    public function getType()
    {
    	return $this->type;
    }

	/**
	 * @return null|MessageInterface
	 */
    public function getMessage()
    {
    	if (empty($this->message)) {
    		return null;
	    }

    	$message = clone $this->message;

    	return $message;
    }

    public function clean()
    {
    	$this->message = null;
    }
}