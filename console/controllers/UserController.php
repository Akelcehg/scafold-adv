<?php

namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        //generating first admin user for project
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();
        return 1;
    }
}
