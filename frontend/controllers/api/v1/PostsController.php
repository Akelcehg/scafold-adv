<?php

namespace frontend\controllers\api\v1;

use yii\rest\ActiveController;

class PostsController extends ActiveController
{
    public $modelClass = 'common\models\Post';
}
