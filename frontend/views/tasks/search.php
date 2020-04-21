<?php


use frontend\web\classes\TimeAgo;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;


//foreach($tasks as $task):
  //echo $task['status'];
debug($tasks);
  //echo '<hr>';
//endforeach;
?>

<div class="main-container page-container">
    <section class="new-task">
        <div class="new-task__wrapper">
            <h1>Новые задания</h1>
            <?php foreach($tasks as $task):
                    if($task['status'] == 0):    ?>
            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="#" class="link-regular"><h2><?= $task['name']?></h2></a>
                    <a  class="new-task__type link-regular" href="#"><p><?= $task['category']['title'];?></p></a>
                </div>
                <div class="new-task__icon new-task__icon--<?= $task['category']['title_en'];?>"></div>
                <p class="new-task_description"><?= $task['description'];?> </p>
                <b class="new-task__price new-task__price--<?= $task['category']['title_en'];?>"><?= $task['budget'];?><b> ₽</b></b>
                <p class="new-task__place"><?= $task['location']['city'];?></p>
                <span class="new-task__time"><?=  (new TimeAgo($task['creation_time']))->getDate(); ?></span>
            </div>
            <?php endif; endforeach;?>

        </div>
       <!--Блок пагинации-->
        <div class="new-task__pagination">

          <?= \yii\widgets\LinkPager::widget(['pagination'=>$pages,
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
    <!--Блок поиска--> <section  class="search-task">
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
                <?php foreach($categories as $category):?>
                <?php echo  Html::checkbox($category->title_en, false,['class'=>'visually-hidden checkbox__input',
                                                                        'id'=>$category->id]);
                    echo Html::label($category->title,$category->id)?>
                <?php endforeach;?>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
                <?php echo  Html::checkbox('response', false,['class'=>'visually-hidden checkbox__input',
                    'id'=>count($categories)+1]);
                echo Html::label('Без откликов',count($categories)+1)?>
                <?php echo  Html::checkbox('teleworking', false,['class'=>'visually-hidden checkbox__input',
                    'id'=>count($categories)+2]);
                echo Html::label('Удаленная работа' ,count($categories)+2)?>
            </fieldset>
            <?= Html::label('Период' ,count($categories)+3,
                                                         [ 'class'=>'search-task__name']) ?>
            <?= Html::dropDownList('time',
							'week', [
							'month' => 'За месяц',
							'week' => 'За неделю',
							'day' => 'За день'],
                      ['class' => 'multiple-select input']);?>
			<?= Html::label('Поиск по названию' ,count($categories)+4,
						[ 'class'=>'search-task__name']) ?>
            <?= Html::tag('input' ,'',
						[ 'class'=>'input-middle input',
                          'id'=>count($categories)+4,
                          'type'=>'search',
                          'name'=>'search-word']) ?>
			<?= Html::submitButton('Искать', ['class'=>'button']);?>
			<?php ActiveForm::end() ;?>
        </div>
    </section>
</div>