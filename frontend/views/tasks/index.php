<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container page-container">
    <section class="new-task">
        <div class="new-task__wrapper">
            <h1>Новые задания</h1>
            <?php Pjax::begin(); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'new-task__card'],
                'itemView' => '_list_item',
                'pager' => [
                    'pageCssClass' => 'pagination__item',
                    'nextPageCssClass' =>'pagination__item',
                    'prevPageCssClass' =>'pagination__item',
                    'activePageCssClass' => 'pagination__item--current',
                    'hideOnSinglePage'=> true,
                    'maxButtonCount' => 3,
                    'options' => ['class' => 'new-task__pagination-list'],
                    'nextPageLabel' => '&#8195',
                    'prevPageLabel' => '&#8195',
                ],
            ]) ?>

            <?php Pjax::end(); ?>
        </div>
    </section>
    <section  class="search-task">
            <div class="search-task__wrapper">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
    </section>
</div>
