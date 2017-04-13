<?php

namespace backend\base\controllers;


use Exception;
use Yii;
use yii\base\ErrorException;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;


/**
 * Базовый контроллер для админки
 * @package backend\base\controllers
 */
class Backend extends Controller
{
    /**
     * Модель с которой работает контроллер
     * @var string
     */
    public $modelClass = null;

    /**
     * Ссылки редиректа после действий
     */
    public $urlAfterCreate = 'index';
    public $urlAfterUpdate = 'index';
    public $urlAfterDelete = 'index';
    public $urlAfterApprove = 'index';
    public $urlAfterDisapprove = 'index';

    /**
     * Подключение общих поведений
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Initialization backend controller
     * @throws \yii\web\HttpException
     */
    public function init()
    {
        if ($this->modelClass === null) {
            //HttpError::the500('Please, set "modelClass" property in your child controller');
            //throw new HttpException('Please, set "modelClass" property in your child controller');
            echo "Dsadsa";
        }

        parent::init();
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $controllerId = $action->controller->id;
        $actionId = $action->id;
        $currentUrl = Yii::$app->request->url;

        Url::remember($currentUrl, "{$controllerId}_{$actionId}");

        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function actions()
    {
        $items = parent::actions();

        if($this->modelClass) {
            $items['sort'] = [
                'class' => SortableGridAction::className(),
                'modelName' => $this->modelClass,
            ];
        }

        return $items;
    }

    /**
     * Вывод списка моделей
     * @return string
     */
    public function actionIndex()
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;
        $get = Yii::$app->request->get();
        $dataProvider = $model->search($get);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Создание модели
     * @return string
     */
    public function actionCreate()
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                AlertHelper::success('Добавлено успешно!');
                $backUrl = Url::previous("{$this->id}_{$this->urlAfterCreate}");

                if ($backUrl) {
                    $this->redirect($backUrl);
                } else {
                    $this->redirect([$this->urlAfterCreate]);
                }
            } else {
                AlertHelper::error("Ошибка добавления!");
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Обновление модели
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;
        $model = $model::findByPk($id);

        if (empty($model)) {
            HttpError::the404();
        }

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                AlertHelper::success('Успешно сохранено!');
                $backUrl = Url::previous("{$this->id}_{$this->urlAfterUpdate}");

                if ($backUrl) {
                    $this->redirect($backUrl);
                } else {
                    $this->redirect([$this->urlAfterUpdate]);
                }
            } else {
                AlertHelper::error("Ошибка сохранения!\n" . print_r($model->errors, true) . "\n");
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Удаление модели
     * @param $id
     * @throws ErrorException
     */
    public function actionDelete($id)
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;

        $pkName = $model->primaryKey();
        if(is_array($pkName)) {
            if(count($pkName) > 1) {
                throw new ErrorException('Composite foreign keys are not allowed.');
            }
            $pkName = $pkName[0];
        }
        $pkName = (string)$pkName;

        try {
            if ($model->deleteAll([$pkName => $id])) {
                AlertHelper::success('Успешно удалено!');
            } else {
                AlertHelper::error('Ошибка удаления!');
            }
        } catch (Exception $ex) {
            AlertHelper::error('Невозможно удалить, используется в связях.');
        }

        if (!Yii::$app->request->isAjax) {
            $backUrl = Url::previous("{$this->id}_{$this->urlAfterDelete}");

            if ($backUrl) {
                $this->redirect($backUrl);
            } else {
                $this->redirect([$this->urlAfterDelete]);
            }
        }
    }

    /**
     * Удаление модели
     * @param $id
     * @throws ErrorException
     */
    public function actionApprove($id)
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;

        $model = $model::findByPk($id);

        if (!$model) {
            HttpError::the404();
        }

        $model->enabled = true;

        if ($model->save()) {
            AlertHelper::success('Успешно опубликовано!');
        } else {
            AlertHelper::error('Ошибка публикации!');
        }

        if (!Yii::$app->request->isAjax) {
            $backUrl = Url::previous("{$this->id}_{$this->urlAfterApprove}");

            if ($backUrl) {
                $this->redirect($backUrl);
            } else {
                $this->redirect([$this->urlAfterApprove]);
            }
        }
    }

    /**
     * Удаление модели
     * @param $id
     * @throws ErrorException
     */
    public function actionDisapprove($id)
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;

        $model = $model::findByPk($id);

        if (!$model) {
            HttpError::the404();
        }

        $model->enabled = false;

        if ($model->save()) {
            AlertHelper::success('Успешно опубликовано!');
        } else {
            AlertHelper::error('Ошибка публикации!');
        }

        if (!Yii::$app->request->isAjax) {
            $backUrl = Url::previous("{$this->id}_{$this->urlAfterDisapprove}");

            if ($backUrl) {
                $this->redirect($backUrl);
            } else {
                $this->redirect([$this->urlAfterDisapprove]);
            }
        }
    }

    /**
     * @return int
     */
    public function actionDeleteSelected()
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;

        $keys = Yii::$app->request->post('selectedIds');
        if(!is_array($keys)) {
            $keys = explode(',', $keys);
        }

        $result = $model->deleteAll(['id' => $keys]);

        return $result;
    }

    /**
     * @return int
     */
    public function actionApproveSelected()
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;

        $keys = Yii::$app->request->post('selectedIds');

        $keys = explode(',', $keys);

        $result = $model->updateAll(['enabled' => true], ['id' => $keys]);

        return $result;
    }

    /**
     * @return int
     */
    public function actionDisapproveSelected()
    {
        /** @var ActiveRecord $model */
        $model = new $this->modelClass;

        $keys = Yii::$app->request->post('selectedIds');

        $keys = explode(',', $keys);

        $result = $model->updateAll(['enabled' => false], ['id' => $keys]);

        return $result;
    }

    /**
     * Детальный просмотр записи в списке
     * @return string
     */
    public function actionDetailView()
    {
        /** @var \common\db\ActiveRecord $model */
        $model = new $this->modelClass;

        $expandRowKey = Yii::$app->request->post('expandRowKey');

        $model = $model::findOne($expandRowKey);

        if(empty($model)) {
            return '<div class="alert alert-danger">No data found</div>';
        }

        return $this->renderPartial('detail-view', ['model' => $model]);
    }
}