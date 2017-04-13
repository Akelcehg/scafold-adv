<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Изменение пользователя: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
