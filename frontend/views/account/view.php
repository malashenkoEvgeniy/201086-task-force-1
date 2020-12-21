<?php


use frontend\models\Categories;
use yii\widgets\ActiveForm;

/* @var $categories Categories */
/* @var $model common\models\User */
/* @var $userCategories */
/* @var $account */
?>
<div class="main-container page-container">
    <section class="account__redaction-wrapper">
        <h1>Редактирование настроек профиля</h1>
      <?php $form = ActiveForm::begin([
        'method' => 'post'
      ]) ?>
        <div class="account__redaction-section">
            <h3 class="div-line">Настройки аккаунта</h3>
            <div class="account__redaction-section-wrapper">
                <div class="account__redaction-avatar">
                    <img src="./img/man-glasses.jpg" width="156" height="156">
                    <a href="#" class="link-regular">Сменить аватар</a>
                </div>
                <div class="account__redaction">


                    <div class="account__input account__input--name">
                      <?= $form->field($model, 'username')->textarea([
                        'class' => 'input textarea',
                        'id' => 200,
                        'disabled' => true,
                        'placeholder' => 'Титов Денис',
                        'rows' => 1
                      ])->label('Ваше имя'); ?>
                    </div>
                    <div class="account__input account__input--email">
                      <?= $form->field($model, 'email')->textarea([
                        'class' => 'input textarea',
                        'id' => 201,
                        'placeholder' => 'DenisT@bk.ru',
                        'rows' => 1
                      ])->label('Email'); ?>
                    </div>
                    <div class="account__input account__input--address">
                        <label for="202">Адрес</label>
                        <input class="input textarea" id="202" name="" placeholder="Санкт-Петербург, Московский район">
                    </div>
                    <div class="account__input account__input--date">
                      <?= $form->field($model, 'birthday')->textarea([
                        'class' => 'input-middle input input-date',
                        'id' => 203,
                        'placeholder' => '15.08.1987',
                        'rows' => 1
                      ])->label('День рождения'); ?>
                    </div>
                    <div class="account__input account__input--info">
                      <?= $form->field($model, 'info')->textarea([
                        'class' => 'input textarea',
                        'id' => 204,
                        'placeholder' => 'Place your text',
                        'rows' => 7
                      ])->label('Информация о себе'); ?>
                    </div>
                </div>
            </div>
            <h3 class="div-line">Выберите свои специализации</h3>
            <div class="account__redaction-section-wrapper">
                <div class="search-task__categories account_checkbox">
                  <?= $form->field($account, $userCategories[0]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[0]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[0]->status ? true : false
                    ]); ?>
                  <?= $form->field($account, $userCategories[1]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[1]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[1]->status ? true : false
                    ]); ?>
                </div>
                <div class="search-task__categories account_checkbox">
                  <?= $form->field($account, $userCategories[2]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[2]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[2]->status ? true : false
                    ]); ?>
                  <?= $form->field($account, $userCategories[3]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[3]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[3]->status ? true : false
                    ]); ?>
                </div>
                <div class="search-task__categories account_checkbox">
                  <?= $form->field($account, $userCategories[4]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[4]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[4]->status ? true : false
                    ]); ?>
                  <?= $form->field($account, $userCategories[5]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[5]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[5]->status ? true : false
                    ]); ?>
                </div>
                <div class="search-task__categories account_checkbox">
                  <?= $form->field($account, $userCategories[6]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[6]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[6]->status ? true : false
                    ]); ?>
                  <?= $form->field($account, $userCategories[7]->category->title_en)
                    ->checkbox([
                      'label' => $userCategories[7]->category->title,
                      'class' => ' checkbox__input',
                      'checked' => $userCategories[7]->status ? true : false
                    ]); ?>
                </div>
            </div>
            <h3 class="div-line">Безопасность</h3>
            <div class="account__redaction-section-wrapper account__redaction">
                <div class="account__input">
                    <label for="211">Новый пароль</label>
                    <input class="input textarea" type="password" id="211" name="" value="moiparol">
                </div>
                <div class="account__input">
                    <label for="212">Повтор пароля</label>
                    <input class="input textarea" type="password" id="212" name="" value="moiparol">
                </div>
            </div>
            <h3 class="div-line">Контакты</h3>
            <div class="account__redaction-section-wrapper account__redaction">
                <div class="account__input">
                    <label for="213">Телефон</label>
                    <input class="input textarea" type="tel" id="213" name="" placeholder="8 (555) 187 44 87">
                </div>
                <div class="account__input">
                    <label for="214">Skype</label>
                    <input class="input textarea" type="password" id="214" name="" placeholder="DenisT">
                </div>
                <div class="account__input">
                    <label for="215">Другой мессенджер</label>
                    <input class="input textarea" id="215" name="" placeholder="@DenisT">
                </div>
            </div>
            <h3 class="div-line">Настройки сайта</h3>
            <h4>Уведомления</h4>
            <div class="account__redaction-section-wrapper account_section--bottom">
                <div class="search-task__categories account_checkbox--bottom">
                    <input class="visually-hidden checkbox__input" id="216" type="checkbox" name="" value="" checked>
                    <label for="216">Новое сообщение</label>
                    <input class="visually-hidden checkbox__input" id="217" type="checkbox" name="" value="" checked>
                    <label for="217">Действия по заданию</label>
                    <input class="visually-hidden checkbox__input" id="218" type="checkbox" name="" value="" checked>
                    <label for="218">Новый отзыв</label>
                </div>
                <div class="search-task__categories account_checkbox account_checkbox--secrecy">
                    <input class="visually-hidden checkbox__input" id="219" type="checkbox" name="" value="">
                    <label for="219">Показывать мои контакты только заказчику</label>
                </div>
            </div>
        </div>
        <button class="button" type="submit">Сохранить изменения</button>


      <?php ActiveForm::end() ?>


    </section>
</div>
