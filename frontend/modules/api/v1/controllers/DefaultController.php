<?php

namespace app\modules\api\v1\controllers;

use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $data = [
            'dadas' => 123,
            'string' => 'ssss',
            'dsadasdsa' => [
                '1' => '2',
                '2' => '3',
            ]
        ];
        return $data;
    }
}


