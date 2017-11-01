<?php

namespace Xoptov\TradingPlatform;

use DateTime;

class DataContainer
{
    /** @var int */
    private $ttl;

    /** @var mixed */
    private $data;

    /** @var DateTime */
    private $expireAt;

    /**
     * DataContainer constructor.
     * @param int $ttl How long data stay fresh in seconds.
     */
    public function __construct($ttl = 60)
    {
        $this->ttl = $ttl;
    }

    /**
     * @param mixed $data
     * @return mixed|null
     */
    public function __invoke($data = null)
    {
        if ($data) {
            $this->data = $data;
            $this->expireAt = new DateTime("+{$this->ttl} second");
        } elseif ($this->isFresh()) {
            return $this->data;
        }

        return null;
    }


    /**
     * @return bool
     */
    public function isFresh()
    {
        $now = new DateTime();

        if (empty($this->expireAt) || $now > $this->expireAt) {
            return false;
        }

        return true;
    }
}