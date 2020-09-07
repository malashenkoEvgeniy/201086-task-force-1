<?php

use common\models\User;
use frontend\classes\TimeAgo;
use yii\helpers\Url;
$users = User::find()->indexBy('id')->all();

?>
<div class="feedback-card__top">
    <div class="user__search-icon">
        <a href="#"><img src="img/<?= $users[$model->id]->ava;?>" width="65" height="65" alt="avatar"></a>
        <span><?= count($model->executorTask);?> заданий</span>
        <span><?= count($model->executorReview);?> отзывов</span>
    </div>
    <div class="feedback-card__top--name user__search-card">
        <p class="link-name">
            <a href="<?=Url::to(['user/view', 'id' => $model->id]);?>" class="link-regular"><?=$model->username;?></a>

        </p>
        <? for($i = 0;$i < 5; $i++):
             if($i<round($model->rating, 0)):
                echo '<span></span>';
             else:
                echo "<span class='star-disabled'></span>";
             endif;
           endfor;?>
      <b><?= $model->rating;?></b>
        <p class="user__search-content"><?=$model->info;?></p>
    </div>
    <span class="new-task__time">
        <?="Был на сайте ".(new TimeAgo($model->last_visit_time))->getDate()." назад";?>
    </span>
</div>
<div class="link-specialization user__search-link--bottom">
    <?php
        foreach ($model->category as $categoryItem): ?>
            <a href="#" class="link-regular"><?=$categoryItem['title']?></a>
        <?php endforeach; ?>
</div>