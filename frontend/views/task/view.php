<?php

use common\models\User;
use frontend\classes\TimeAgo;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Task */
/* @var $user User */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="main-container page-container">
    <section class="content-view">
        <div class="content-view__card">
            <div class="content-view__card-wrapper">
                <div class="content-view__header">
                    <div class="content-view__headline">
                        <h1><?= $model->name ?></h1>
                        <span>Размещено в категории
                            <a href="#" class="link-regular"><?= $model->category->title ?></a>
                            <?= (new TimeAgo($model->created_at))->getDate(); ?> назад</span>
                    </div>
                    <b class="new-task__price new-task__price--<?= $model->category->title_en ?> content-view-price"><?= $model->budget ?>
                        <b> ₽</b></b>
                    <div class="new-task__icon new-task__icon--<?= $model->category->title_en ?> content-view-icon"></div>
                </div>
                <div class="content-view__description">
                    <h3 class="content-view__h3">Общее описание</h3>
                    <p><?= $model->description ?></p>
                </div>
                <div class="content-view__attach">
                    <h3 class="content-view__h3">Вложения</h3>
                    <a href="#">my_picture.jpeg</a>
                    <a href="#">agreement.docx</a>
                </div>
                <div class="content-view__location">
                    <h3 class="content-view__h3">Расположение</h3>
                    <div class="content-view__location-wrapper">
                        <div class="content-view__map">
                            <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                             alt="Москва, Новый арбат, 23 к. 1"></a>
                        </div>
                        <div class="content-view__address">
                            <span class="address__town">Москва</span><br>
                            <span>Новый арбат, 23 к. 1</span>
                            <p>Вход под арку, код домофона 1122</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-view__action-buttons">
                <?php Modal::begin([
                  'header' => '<h2>Отклик на задание</h2>',
                  'toggleButton' => [
                    'label' => 'Откликнуться',
                    'tag' => 'button',
                    'type' => 'button',
                    'class' => 'button button__big-color response-button',
                  ],
                  'closeButton' => [
                    'label' => 'Закрыть',
                    'tag' => 'button',
                    'class' => 'form-modal-close',
                    'id' => 'close-modal'
                  ],
                  'options' => [
                    'tag' => 'section',
                    'class' => 'modal response-form form-modal'

                  ],
                ]); ?>
                <?php $form = ActiveForm::begin(['method' => 'post']); ?>

                <?= $form->field($model, 'budget')->textInput([
                  'class' => 'response-form-payment input input-middle input-money',
                  'id' => 'response-payment',
                  'name' => 'response-payment',
                ])->label('Ваша цена', ['class' => 'form-modal-description']); ?>

                <?= $form->field($model, 'name')->textarea([
                  'class' => 'input textarea',
                  'id' => "response-comment",
                  'placeholder' => 'Place your text',
                  'name' => 'response-comment',
                  'rows' => 4
                ])->label('Комментарий', ['class' => 'form-modal-description']); ?>
                <?= Html::submitButton('Отправить', ['class' => 'button modal-button']) ?>
                <?php ActiveForm::end(); ?>
                <?php Modal::end() ?>
                <?php Modal::begin([
                  'header' => '<h2>Отказ от задания</h2>',
                  'toggleButton' => [
                    'label' => 'Отказаться',
                    'tag' => 'button',
                    'type' => 'button',
                    'class' => 'button button__big-color refusal-button',
                  ],
                  'closeButton' => [
                    'label' => 'Закрыть',
                    'tag' => 'button',
                    'class' => 'form-modal-close',
                    'id' => 'close-modal'
                  ],
                  'options' => [
                    'tag' => 'section',
                    'class' => 'modal form-modal refusal-form'

                  ],
                ]); ?>
                <p class="refusal-form-p">
                    Вы собираетесь отказаться от выполнения задания.
                    Это действие приведёт к снижению вашего рейтинга.
                    Вы уверены?
                </p>
                <button class="button__form-modal button"
                        type="button">Отмена
                </button>
                <button class="button__form-modal refusal-button button"
                        type="button">Отказаться
                </button>
                <?php Modal::end() ?>
                <?php Modal::begin([
                  'header' => '<h2>Завершение задания</h2>',
                  'toggleButton' => [
                    'label' => 'Завершить',
                    'tag' => 'button',
                    'type' => 'button',
                    'class' => 'button button__big-color request-button',
                  ],
                  'closeButton' => [
                    'label' => 'Закрыть',
                    'tag' => 'button',
                    'class' => 'form-modal-close',
                    'id' => 'close-modal'
                  ],
                  'options' => [
                    'tag' => 'section',
                    'class' => 'modal completion-form form-modal'

                  ],
                ]); ?>
                <p class="form-modal-description">Задание выполнено?</p>
                <?php $form = ActiveForm::begin(['method' => 'post']); ?>
                <input class="visually-hidden completion-input completion-input--yes" type="radio"
                       id="completion-radio--yes" name="completion" value="yes">
                <label class="completion-label completion-label--yes" for="completion-radio--yes">Да</label>
                <input class="visually-hidden completion-input completion-input--difficult" type="radio"
                       id="completion-radio--yet" name="completion" value="difficulties">
                <label class="completion-label completion-label--difficult" for="completion-radio--yet">Возникли
                    проблемы</label>
                <p>
                    <label class="form-modal-description" for="completion-comment">Комментарий</label>
                    <textarea class="input textarea" rows="4" id="completion-comment" name="completion-comment"
                              placeholder="Place your text"></textarea>
                </p>
                <p class="form-modal-description">
                    Оценка
                <div class="feedback-card__top--name completion-form-star">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span class="star-disabled"></span>
                </div>
                </p>
                <button class="button modal-button" type="submit">Отправить</button>
                <?php ActiveForm::end(); ?>
                <?php Modal::end() ?>

                <button class="button button__big-color connection-button"
                        type="button">Написать сообщение
                </button>
            </div>
        </div>
        <div class="content-view__feedback">
            <h2>Отклики <span>(2)</span></h2>
            <div class="content-view__feedback-wrapper">
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="#"><img src="<?= $user->ava ?>" width="55" height="55"></a>
                        <div class="feedback-card__top--name">
                            <p><a href="#" class="link-regular">Астахов Павел</a></p>
                            <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                            <b>4.25</b>
                        </div>
                        <span class="new-task__time">25 минут назад</span>
                    </div>
                    <div class="feedback-card__content">
                        <p>
                            Могу сделать всё в лучшем виде. У меня есть необходимый опыт и инструменты.
                        </p>
                        <span>1500 ₽</span>
                    </div>
                    <div class="feedback-card__actions">

                        <button class="button__small-color response-button button"
                                type="button">Откликнуться
                        </button>

                        <button class="button__small-color refusal-button button"
                                type="button">Отказаться
                        </button>
                        <button class="button__chat button"
                                type="button"></button>
                    </div>
                </div>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="#"><img src="./img/man-blond.jpg" width="55" height="55"></a>
                        <div class="feedback-card__top--name">
                            <p class="link-name"><a href="#" class="link-regular">Богатырев Дмитрий</a></p>
                            <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                            <b>4.25</b>
                        </div>
                        <span class="new-task__time">25 минут назад</span>
                    </div>
                    <div class="feedback-card__content">
                        <p>
                            Примусь за выполнение задания в течение часа, сделаю быстро и качественно.
                        </p>
                        <span>1500 ₽</span>
                    </div>
                    <div class="feedback-card__actions">
                        <button class="button__small-color response-button button"
                                type="button">Откликнуться
                        </button>
                        <button class="button__small-color refusal-button button"
                                type="button">Отказаться
                        </button>
                        <button class="button__chat button"
                                type="button"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="connect-desk">
        <div class="connect-desk__profile-mini">
            <div class="profile-mini__wrapper">
                <h3>Заказчик</h3>
                <div class="profile-mini__top">
                    <img src="/img/<?= $user->ava ?>" width="62" height="62" alt="Аватар заказчика">
                    <div class="profile-mini__name five-stars__rate">
                        <p><?= $user->username; ?></p>
                        <? for ($i = 0; $i < 5; $i++):
                            if ($i < round($user->rating / 100, 0)):
                                echo '<span></span>';
                            else:
                                echo "<span class='star-disabled'></span>";
                            endif;
                        endfor; ?>
                        <b><?= round($user->rating / 100, 2); ?></b>
                    </div>
                </div>
                <p class="info-customer"><span>15 отзывов</span><span class="last-">28 заказов</span></p>
                <a href="#" class="link-regular">Смотреть профиль</a>
            </div>
        </div>
        <div class="connect-desk__chat">
            <h3>Переписка</h3>
            <div class="chat__overflow">
                <div class="chat__message chat__message--out">
                    <p class="chat__message-time">10.05.2019, 14:56</p>
                    <p class="chat__message-text">Привет. Во сколько сможешь
                        приступить к работе?</p>
                </div>
                <div class="chat__message chat__message--in">
                    <p class="chat__message-time">10.05.2019, 14:57</p>
                    <p class="chat__message-text">На задание
                        выделены всего сутки, так что через час</p>
                </div>
                <div class="chat__message chat__message--out">
                    <p class="chat__message-time">10.05.2019, 14:57</p>
                    <p class="chat__message-text">Хорошо. Думаю, мы справимся</p>
                </div>
            </div>
            <p class="chat__your-message">Ваше сообщение</p>
            <form class="chat__form">
                <textarea class="input textarea textarea-chat" rows="2" name="message-text"
                          placeholder="Текст сообщения"></textarea>
                <button class="button chat__button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
</div>

<section class="modal completion-form form-modal">
    <h2>Завершение задания</h2>
    <p class="form-modal-description">Задание выполнено?</p>
    <?php $form = ActiveForm::begin(['method' => 'post']); ?>
    <input class="visually-hidden completion-input completion-input--yes" type="radio" id="completion-radio--yes"
           name="completion" value="yes">
    <label class="completion-label completion-label--yes" for="completion-radio--yes">Да</label>
    <input class="visually-hidden completion-input completion-input--difficult" type="radio" id="completion-radio--yet"
           name="completion" value="difficulties">
    <label class="completion-label completion-label--difficult" for="completion-radio--yet">Возникли проблемы</label>
    <p>
        <label class="form-modal-description" for="completion-comment">Комментарий</label>
        <textarea class="input textarea" rows="4" id="completion-comment" name="completion-comment"
                  placeholder="Place your text"></textarea>
    </p>
    <p class="form-modal-description">
        Оценка
    <div class="feedback-card__top--name completion-form-star">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span class="star-disabled"></span>
    </div>
        </p>
        <button class="button modal-button" type="submit">Отправить</button>
    </form>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>