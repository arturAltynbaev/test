<?php

namespace Service;

use Service\Strategy\HandlerStrategyInterface;

class DataHandler
{
    /**
     * @var HandlerStrategyInterface
     */
    private $strategy;

    /**
     * DataHandler constructor.
     *
     * @param HandlerStrategyInterface $strategy
     */
    public function __construct(HandlerStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function getEuro($data)
    {
        return $this->strategy->handle($data);
    }
}
