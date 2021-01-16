<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'category_id',
                'name',

                'price',
                //'keywords',
                //'description',
                //'img',
                //'hit',
                //'new',
                //'sale',
                //'im',
                //'wozr',
                //'zan',
                //'grafrab',
                //'kontakt',
                //'pohta',
                //'tel',
                //'city',
                //'fam',
                //'pol',
                //'addtime',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>


</div>
