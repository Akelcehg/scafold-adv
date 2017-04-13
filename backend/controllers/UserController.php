<?php

namespace backend\controllers;

use common\models\User;
use yii\base\Controller;

/**
 * Site controller
 */
class UserController extends Controller
{

    public function actionIndex()
    {
        $model = User::find()->all();
        /*$get = Yii::$app->request->get();
        $dataProvider = $model->search($get);*/

        return $this->render('index', [
            'model' => $model,
            //'dataProvider' => $dataProvider
        ]);
    }

}
