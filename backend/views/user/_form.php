<?php

use common\models\Region;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
	'options' => ['enctype' => 'multipart/form-data'],
]); ?>
	<div class="box-body">
		<legend>Основные свойства</legend>

		<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'bornAt') ?>

		<?= $form->field($model, 'region_id')->widget(\kartik\widgets\Select2::classname(), [
			'data' => Region::listAll('id', 'title'),
			'pluginOptions' => [
				'allowClear' => false
			],
		]) ?>

		<?php if(!$model->isNewRecord) : ?>
			<legend>Дополнительная информация</legend>
			<?= $form->field($model, 'actions_points')->textInput(['disabled' => true]) ?>
			<?= $form->field($model, 'credits')->textInput(['disabled' => true]) ?>
			<?= $form->field($model, 'created_at')->textInput(['disabled' => true]) ?>
			<?= $form->field($model, 'updated_at')->textInput(['disabled' => true]) ?>
		<?php endif; ?>
	</div>
	<div class="box-footer">
		<?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>
<?php ActiveForm::end(); ?>
