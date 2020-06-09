<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\Users*/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Locations;
//use frontend\models\Users;
use yii\helpers\ArrayHelper;


$this->title = 'Регистрация аккаунта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container page-container">
    <section class="registration__user">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="registration-wrapper">
            <?php $form = ActiveForm::begin([//'action' => ['index'],
                                            'options'=> ['class' => 'registration__user-form form-create']]); ?>

            <?= $form->field($model, 'email')
                    ->textarea(['autofocus' => true,
                                'class' => 'input textarea',
                                'placeholder' => 'kumarm@mail.ru',
                                'rows' => 1,
                                'style' => 'width: 100%',])
                    ->hint('Введите валидный адрес электронной почты')
                    ->label('Электронная почта'); ?>
            <?= $form->field($model, 'name')
                    ->textarea([
                        'class' => 'input textarea',
                        'placeholder' => 'Мамедов Кумар',
                        'rows' => 1,
                        'style' => 'width: 100%',])
                    ->hint('Введите ваше имя и фамилию')
                    ->label('Ваше имя'); ?>
            <?= $form->field($model, 'location_id')
                ->dropDownList(ArrayHelper::map( Locations::find()->all(), 'id', 'city'),[
                    'class' => 'multiple-select input town-select registration-town',
                    'rows' => 1,
                    'prompt'=> 'Укажите город',
                    'style' => 'width: 100%',])
                ->hint('Укажите город, чтобы находить подходящие задачи')
                ->label('Город проживания'); ?>
            <?= $form->field($model, 'password')->passwordInput([
                    'class' => 'input textarea',
                    'rows' => 1,
                    'style' => 'width: 100%',
                    'labelOptions'=>[
                       'class' => 'input-danger'
                    ]
                        ])
                    ->hint('Длина пароля от 8 символов')
                    ->label('Пароль'); ?>

            <div class="form-group">
            <?= Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </section>

</div>