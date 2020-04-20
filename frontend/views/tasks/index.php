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
//	debug($task);
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
			        'options'=> ['class'=>'search-task__form']

            ]) ;?>
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <?= $form->field($model,'translation')
                  ->checkbox(['name'=>'translation',
                              'id'=>1,
                               'template' => '{input}{label}',
                               'options'=>[
                                'class'=> 'checkbox__input'
                                ]], false);

					//$form->field($model, 'rememberMe')->checkbox(['template' => '{input}{label}']);
?>
            </fieldset>
			<?= Html::submitButton('Искать', ['class'=>'button']);?>
			<?php ActiveForm::end() ;?>
            <form class="search-task__form" name="test" method="get" action="<?= \yii\helpers\Url::to('tasks/search')?>">
                <fieldset class="search-task__categories">
                    <legend>Категории</legend>
                    <input class="visually-hidden checkbox__input" id="1" type="checkbox" name="1" value="услуги" checked>
                    <label for="1">Курьерские услуги </label>
                    <input class="visually-hidden checkbox__input" id="2" type="checkbox" name="2" value="перевозки" checked>
                    <label  for="2">Грузоперевозки </label>
                    <input class="visually-hidden checkbox__input" id="3" type="checkbox" name="3" value="">
                    <label  for="3">Переводы </label>
                    <input class="visually-hidden checkbox__input" id="4" type="checkbox" name="4" value="">
                    <label  for="4">Строительство и ремонт </label>
                    <input class="visually-hidden checkbox__input" id="5" type="checkbox" name="5" value="">
                    <label  for="5">Выгул животных </label>
                </fieldset>
                <fieldset class="search-task__categories">
                    <legend>Дополнительно</legend>
                    <input class="visually-hidden checkbox__input" id="6" type="checkbox" name="отклик" value="">
                    <label for="6">Без откликов</label>
                    <input class="visually-hidden checkbox__input" id="7" type="checkbox" name="удаленно" value="" checked>
                    <label for="7">Удаленная работа </label>
                </fieldset>
                <label class="search-task__name" for="8">Период</label>
                <select class="multiple-select input" id="8" size="1" name="time[]">
                    <option value="day">За день</option>
                    <option selected value="week">За неделю</option>
                    <option value="month">За месяц</option>
                </select>
                <label class="search-task__name" for="9">Поиск по названию</label>
                <input class="input-middle input" id="9" type="search" name="search_word" placeholder="">
                <button class="button" type="submit">Искать</button>
            </form>
        </div>
    </section>
</div>