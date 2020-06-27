<?php

use frontend\classes\TimeAgo;
use yii\helpers\Url;

?>
<div class="feedback-card__top">
    <div class="user__search-icon">
        <a href="#"><img src="<?= $model->avatar;?>" width="65" height="65" alt="avatar"></a>
        <span><?= count($model->executorTasks);?> заданий</span>
        <span><?= count($model->executorReviews);?> отзывов</span>
    </div>
    <div class="feedback-card__top--name user__search-card">
        <p class="link-name">
            <a href="<?=Url::to(['users/view', 'id' => $model->id]);?>" class="link-regular"><?=$model->name;?></a>

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
        foreach ($model->categories as $categoryItem): ?>
            <a href="#" class="link-regular"><?=$categoryItem['title']?></a>
        <?php endforeach; ?>
</div>