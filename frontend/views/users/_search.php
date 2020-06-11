<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'id'=>'tasks-form',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class'=>'search-task__form',
            'name'=>'users',
        ],
    ]); ?>
    <fieldset class="search-task__categories">
        <legend>Категории</legend>

	<?php  echo $form->field($model, 'categories')
		->checkboxList([1 => 'Курьерские услуги',
			2 =>	'Уборка',
			3 =>	'Переезды',
			4 =>	'Компьютерная помощь',
			5 =>	'Ремонт квартирный',
			6 =>	'Ремонт техники',
			7 =>	'Красота',
			8 =>	'Фото'],
                        [
                          'item' => function($index, $label, $name, $checked, $value) {
							return '<input class="visually-hidden checkbox__input" 
                                      id="interview-' . $index . '" name="' . $name . '" type="checkbox" ' .
                                      $checked . ' value="' . $value . '">
                                    <label for="interview-' . $index . '">' . $label . '</label>';
		                    }
                        ])->label('');
        ?>

    </fieldset>

    <fieldset class="search-task__categories">
      <legend>Дополнительно</legend>
      <?php
      /*

        Не нашел как таким образом настраивать чекбокс чтоб не было дива.
 echo $form->field($model, 'now_free')->checkbox([
              ['template' => "{input}{label}"],
				'label' => '123',
				'class' => 'visually-hidden checkbox__input',
			])->label('Сейчас свободен');*/?>
			<?php echo  Html::checkbox('now-free', false,['class'=>'visually-hidden checkbox__input','id'=>15]);
			echo Html::label('Сейчас свободен',15)?>
			<?php echo  Html::checkbox('online-now', false,['class'=>'visually-hidden checkbox__input', 'id'=>16]);
			echo Html::label('Сейчас онлайн' ,16)?>
			<?php echo  Html::checkbox('there-are-reviews', false,['class'=>'visually-hidden checkbox__input', 'id'=>17]);
			echo Html::label('Есть отзывы' ,17)?>
			<?php echo  Html::checkbox('in-favorites', false,['class'=>'visually-hidden checkbox__input', 'id'=>18]);
			echo Html::label('В избранном' ,18)?>
    </fieldset>
                <label class="search-task__name">Поиск по названию</label>
	<?php echo $form->field($model, 'name')->textInput(['class' => 'input-middle input'])->label('')?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

