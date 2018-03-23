<?php

namespace Service\Strategy;

class RussianBankStrategy implements HandlerStrategyInterface
{
    /**
     * @param $data
     *
     * @return string
     */
    public function handle($data) {
        if (empty($data)) {
            return '';
        }
        $arrData = json_decode($data, true);

        return isset($arrData['Valute']['EUR']['Value']) ? $arrData['Valute']['EUR']['Value'] : '';
    }
}
