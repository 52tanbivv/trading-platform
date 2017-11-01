<?php

namespace Xoptov\TradingPlatform\Channel;

use \SplDoublyLinkedList;
use Xoptov\TradingPlatform\Message\MessageInterface;

class PushChannel implements \SplSubject
{
    /** @var SplDoublyLinkedList */
    private $observers;

    /** @var MessageInterface */
    private $message;

    /** @var int */
    private $type;

	/**
	 * PushChannel constructor.
	 * @param int $type
	 */
    public function __construct($type)
    {
    	$this->observers = new SplDoublyLinkedList();
    	$this->type = $type;
    }

	/**
	 * {@inheritdoc}
	 * @return bool
	 */
    public function attach(\SplObserver $observer)
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
    public function detach(\SplObserver $observer)
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

    public function clean()
    {
    	$this->message = null;
    }
}