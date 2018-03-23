<?php

namespace Service\Strategy;

interface HandlerStrategyInterface
{
    /**
     * @param $data
     *
     * @return string
     */
    public function handle($data);
}
