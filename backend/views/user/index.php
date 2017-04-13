<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'id',
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'username',
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'email',
    ],
    /*[
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'status',
        'vAlign' => 'middle',
    ],*/
    /*    [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => true,
            'vAlign' => 'middle',
            'urlCreator' => function ($action, $model, $key, $index) {
                return '#';
            },
            'viewOptions' => ['title' => 'Просмотри', 'data-toggle' => 'tooltip'],
            'updateOptions' => ['title' => '1', 'data-toggle' => 'tooltip'],
            'deleteOptions' => ['title' => '2', 'data-toggle' => 'tooltip'],
        ],*/
    ['class' => 'kartik\grid\CheckboxColumn']
];
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    /*'beforeHeader' => [
        [
            'columns' => [
                ['content' => 'Header Before 1', 'options' => ['colspan' => 4, 'class   ' => 'text-center warning']],
                ['content' => 'Header Before 2', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                ['content' => 'Header Before 3', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
            ],
            'options' => ['class' => 'skip-export']
        ]
    ],*/
    'toolbar' => [
        ['content' =>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => 'Add Book', 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
        ],
        '{export}',
        '{toggleData}'
    ],
    'pjax' => false,
    'bordered' => false,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => false,
    'floatHeaderOptions' => ['scrollingTop' => 'true'],
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY
    ],
]);