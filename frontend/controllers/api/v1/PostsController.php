<?php

namespace frontend\controllers\api\v1;

use common\models\PostSearch;
use yii\rest\ActiveController;

class PostsController extends ActiveController
{
    public $modelClass = 'common\models\Post';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new PostSearch();
        $searchModel->load(\Yii::$app->request->queryParams, '');
        return $searchModel->search();
    }

}
