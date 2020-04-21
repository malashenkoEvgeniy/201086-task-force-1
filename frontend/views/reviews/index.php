<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reviews', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creation_time',
            'customer_id',
            'executor_id',
            'assessment',
            //'task_id',
            //'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
