<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

foreach ($users as $user):
?>
    <div class="content-view__feedback-card user__search-wrapper">
        <div class="feedback-card__top">
            <div class="user__search-icon">
                <a href="#"><img src=".<?= $user['files']['path']?>" width="65" height="65"></a>
                <span>17 заданий</span>
                <span>6 отзывов</span>
            </div>
            <div class="feedback-card__top--name user__search-card">
                <p class="link-name"><a href="#" class="link-regular">Астахов Павел</a></p>
                <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                <b>4.25</b>
                <p class="user__search-content">
                    Сложно сказать, почему элементы политического процесса лишь
                    добавляют фракционных разногласий и рассмотрены исключительно
                    в разрезе маркетинговых и финансовых предпосылок.
                </p>
            </div>
            <span class="new-task__time">Был на сайте 25 минут назад</span>
        </div>
        <div class="link-specialization user__search-link--bottom">
            <a href="#" class="link-regular">Ремонт</a>
            <a href="#" class="link-regular">Курьер</a>
            <a href="#" class="link-regular">Оператор ПК</a>
        </div>
    </div>
<?php endforeach;?>


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
<hr>
<?php
echo "<pre>";
print_r($users);
echo "</pre>";