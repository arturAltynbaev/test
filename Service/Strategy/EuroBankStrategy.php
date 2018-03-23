<?php

namespace Service\Strategy;

class EuroBankStrategy implements HandlerStrategyInterface
{
    /**
     * @param $data
     *
     * @return string
     */
    public function handle($data) {
        $euro = '';

        if (empty($data)) {
            return $euro;
        }

        $xml = simplexml_load_string($data);

        foreach ($xml->Cube[0]->Cube[0]->Cube as $cube) {
            if (isset($cube['currency']) && (string)$cube['currency'] === 'RUB') {
                $euro = (string)$cube['rate'];
            }
        }

        return $euro;
    }
}
