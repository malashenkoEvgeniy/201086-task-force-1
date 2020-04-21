<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SearchUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'creation_time') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'skype') ?>

    <?php // echo $form->field($model, 'another_messenger') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'task_name') ?>

    <?php // echo $form->field($model, 'show_contacts_for_customer') ?>

    <?php // echo $form->field($model, 'hide_profile') ?>

    <?php // echo $form->field($model, 'last_visit_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
