<?php

namespace frontend\modules\api\base;

use Yii;
use yii\rest\Controller;
use yii\web\Response;


/**
 * Базовый контроллер АПИ
 * @package frontend\modules\api\base\controllers
 */
class RestController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = ['application/json' => Response::FORMAT_JSON];
        return $behaviors;
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if ($this->paramGet('api.crossDomainAllow')) {
            Yii::$app->response->getHeaders()->add('Access-Control-Allow-Origin', '*');
        }

        return parent::beforeAction($action);
    }

    private function paramGet($action)
    {
        $params = Yii::$app->params;

        if (!isset($params[$action])) {
            //HttpError::the500("Key not found: {$action}");
            return [
                'error' => "Key not found: {$action}"
            ];
        }

        return $params[$action];
    }
}
