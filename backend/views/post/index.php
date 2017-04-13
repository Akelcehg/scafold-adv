<?php

use kartik\grid\GridView;
use yii\helpers\Html;


$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'id',
    ],
    [
        'attribute' => 'text',
    ],
    [
        'attribute' => 'theme',
    ],
    [
        'attribute' => 'author',
    ],
    [
        'attribute' => 'publisher_id',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return '#';
        },
        'viewOptions' => ['title' => 'Просмотри', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => 'Редактировать', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['title' => 'Удалить', 'data-toggle' => 'tooltip'],
    ],
    ['class' => 'kartik\grid\CheckboxColumn']
];
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
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
        //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => 'Add Book', 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Add']) .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
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
    'showPageSummary' => false,
    'panel' => [
        'type' => GridView::TYPE_INFO
    ],
]);