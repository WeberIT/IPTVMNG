<?php

use yii\helpers\Html;
use yii\grid\GridView;

$request = \Yii::$app->request;
$this->title = 'Streams Grid';
$this->params['breadcrumbs'][]=['label'=>'IPTV Monitor', 'url'=>['index']];
$this->params['breadcrumbs'][] = ['label'=>'Servers Fault', 'url'=>'servers-fault'];
$this->params['breadcrumbs'][] = $this->title;

$enables = [
    0 => 'down',
    1 => 'up',
];

$columns = [
    [
        'class' => 'yii\grid\SerialColumn',
        'headerOptions' => ['width' => '10'],
    ],
    'streamName',
    [
        'attribute' => 'server',
        'filter' => $servers
    ],
    [
        'attribute' => 'status',
        'value' => function($model){
            return $model->status == 1 ? 'up' : 'down';
        },
        'filter' => $enables,
        'headerOptions' => ['width' => '85'],
    ],
    'source',
    [
        'attribute' => 'sourceStatus',
        'value' => function($model){
            return $model->sourceStatus == 1 ? 'up' : 'down';
        },
        'filter' => $enables,
        'headerOptions' => ['width' => '85'],
    ]
];

?>

<div class="btn-group right">
	<?= Html::a('<i class="iconfont iconfont-blue icon-linechart"></i>', ['servers-fault'], ['class' => 'btn btn-default']);?>
	<?= Html::a('<i class="iconfont iconfont-blue icon-grid"></i>', null, ['class' => 'btn btn-default', 'style'=>"background-color:#CCCCCC"]);?>
</div><br/><br/>

<?php 
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pager' => [
        'firstPageLabel' => 'First Page',
        'lastPageLabel' => 'Last Page',
    ],
    'rowOptions' => function($model, $key, $index, $grid){
        return ['class' => $index % 2 == 0 ? 'label-white' : 'label-grey' ];
    },
    'columns' => $columns
]);