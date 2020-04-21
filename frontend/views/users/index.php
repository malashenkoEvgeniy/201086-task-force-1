<?php

use frontend\web\classes\TimeAgo;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="main-container page-container">
    <section class="user__search">
        <div class="user__search-link">
            <p>Сортировать по:</p>
            <ul class="user__search-list">
                <li class="user__search-item user__search-item--current">
                    <a href="#" class="link-regular">Рейтингу</a>
                </li>
                <li class="user__search-item">
                    <a href="#" class="link-regular">Числу заказов</a>
                </li>
                <li class="user__search-item">
                    <a href="#" class="link-regular">Популярности</a>
                </li>
            </ul>
        </div>
        <?php foreach ($newUser as $item): ?>
        <div class="content-view__feedback-card user__search-wrapper">
            <div class="feedback-card__top">
                <div class="user__search-icon">
                    <a href="#"><img src="<?= $item['avatar'];?>" width="65" height="65" alt=""></a>
                    <span><?= $item['count-tasks'];?> заданий</span>
                    <span><?= $item['count-reviews'];?> отзывов</span>
                </div>
                <div class="feedback-card__top--name user__search-card">
                    <p class="link-name"><a href="#" class="link-regular"><?= $item['name'];?></a></p>
                    <?php for($i = 0;$i < 5; $i++):
                        if($i<=$item['assessment-stars']):
							echo '<span></span>';
						 else:
                            echo "<span class='star-disabled'></span>";
							endif; endfor;?>
                    <b><?= round($item['count-assessment'], 1);?></b>
                    <p class="user__search-content"><?= $item['info'];?></p>
                </div>
                <span class="new-task__time"><?="Был на сайте ".(new TimeAgo($item['last_visit_time']))->getDate();?></span>
            </div>
            <div class="link-specialization user__search-link--bottom">
                <?php foreach($item['categories'] as $itemCategory): ?>
                    <a href="#" class="link-regular"><?= $itemCategory;?></a>
                <?php endforeach;?>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="new-task__pagination">

        <?= LinkPager::widget(['pagination'=>$pages,
            'pageCssClass' => 'pagination__item',
            'nextPageCssClass' =>'pagination__item',
            'prevPageCssClass' =>'pagination__item',
            'activePageCssClass' => 'pagination__item--current',
            'hideOnSinglePage'=> true,
            'maxButtonCount' => 3,
            'options' => ['class' => 'new-task__pagination-list'],
            'nextPageLabel' => '&#8195',
            'prevPageLabel' => '&#8195'
        ]);
        ?>
        </div>

    </section>
    <section  class="search-task">
        <div class="search-task__wrapper">
					<?php $form = ActiveForm::begin([
						'id'=>'tasks-form',
						'method'=>'get',
						'action'=>'?r=tasks/search',
						'options'=> ['class'=>'search-task__form',
							'name'=>'q']
					]) ;?>
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <?php foreach($categories as $category): ?>
                    <?php echo  Html::checkbox($category->title_en, false,['class'=>'visually-hidden checkbox__input',                        'id'=>$category->id]);
                    echo Html::label($category->title,$category->id)?>
                <?php endforeach;?>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
                <?php echo  Html::checkbox('now-free', false,['class'=>'visually-hidden checkbox__input',
                    'id'=>count($categories)+1]);
                echo Html::label('Сейчас свободен',count($categories)+1)?>
                <?php echo  Html::checkbox('online-now', false,['class'=>'visually-hidden checkbox__input',
                    'id'=>count($categories)+2]);
                echo Html::label('Сейчас онлайн' ,count($categories)+2)?>
                <?php echo  Html::checkbox('there-are-reviews', false,['class'=>'visually-hidden checkbox__input',
                    'id'=>count($categories)+3]);
                echo Html::label('Есть отзывы' ,count($categories)+3)?>
                <?php echo  Html::checkbox('in-favorites', false,['class'=>'visually-hidden checkbox__input',
                    'id'=>count($categories)+4]);
                echo Html::label('В избранном' ,count($categories)+4)?>
            </fieldset>
                <?= Html::label('Поиск по имени' ,count($categories)+5,
                    [ 'class'=>'search-task__name']) ?>
                <?= Html::tag('input' ,'',
                    [ 'class'=>'input-middle input',
                        'id'=>count($categories)+5,
                        'type'=>'search',
                        'name'=>'search-word']) ?>
                <?= Html::submitButton('Искать', ['class'=>'button']);?>
                <?php ActiveForm::end() ;?>
        </div>
    </section>
</div>
