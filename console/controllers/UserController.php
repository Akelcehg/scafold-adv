<?php

namespace console\controllers;


use common\models\Admin;
use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        //generating first admin user for project
        echo "Generating user" . PHP_EOL;
        $user = new User();
        $user->username = 'user';
        $user->email = 'user@gmail.com';
        $user->setPassword('user');
        $user->generateAuthKey();
        $user->save();

        echo "Generating Admin" . PHP_EOL;
        $admin = new Admin();
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->setPassword('admin');
        $admin->generateAuthKey();
        $admin->save();
        return 1;
    }
}
