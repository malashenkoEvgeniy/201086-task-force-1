<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creation_time',
            'name',
            'email:email',
            'location_id',
            //'birthday',
            //'info:ntext',
            //'password',
            //'phone',
            //'skype',
            //'another_messenger',
            //'avatar',
            //'task_name',
            //'show_contacts_for_customer',
            //'hide_profile',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
