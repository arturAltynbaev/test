<?php

namespace app\controllers;

use Service\DataHandler;
use Service\Strategy\EuroBankStrategy;
use Service\Strategy\RussianBankStrategy;
use Yii;
use yii\web\Controller;
use GuzzleHttp\Client;

class EuroController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $isAjax = (isset($get['type']) && ($get['type'] === 'ajax'));
        $msg = 'Service is temporarily unavailable. Try again later.';
        $sourcesList = Yii::$app->params['EuroSourcesList'];

        foreach ($sourcesList as $source) {
            $httpClient = new Client(['base_uri' => $source['url']]);
            $response = $httpClient->request('GET');

            if ($response->getStatusCode() !== 200) {
                continue;
            }

            switch ($source['strategy']) {
                case 'EuroBank';
                    $strategy = new EuroBankStrategy();
                    break;
                case 'RussianBank';
                    $strategy = new RussianBankStrategy();
                    break;
                default:
                    $strategy = null;
            }

            if (empty($strategy)) {
                continue;
            }

            $dataHandler = new DataHandler($strategy);
            $euro = $dataHandler->getEuro($response->getBody());

            if (empty($euro)) {
                continue;
            }
            $euro = round($euro, 2);

            if ($isAjax) {
                return json_encode(['status' => 'ok', 'msg' => $euro]);
            }

            return $this->render('index', ['euro' => $euro, 'msg' => '']);
        }

        if ($isAjax) {
            return json_encode(['status' => 'error', 'msg' => $msg]);
        }

        return $this->render('index', ['euro' => '', 'msg' => $msg]);
    }
}
