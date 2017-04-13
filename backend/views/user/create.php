<?php

use common\models\Region;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \frontend\forms\RegisterForm */

$this->title = 'Новая запись';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <div class="box-body">
                <legend>Основные свойства</legend>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password_confirm')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'bornAt') ?>

                <?= $form->field($model, 'region_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => Region::listAll('id', 'title'),
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]) ?>
            </div>
            <div class="box-footer">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>