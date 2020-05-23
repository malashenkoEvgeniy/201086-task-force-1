<?php

use frontend\web\classes\TimeAgo;

?>
<div class="feedback-card__top">
    <div class="user__search-icon">
        <a href="#"><img src="<?= $model->avatar;?>" width="65" height="65"></a>
        <span><?= $model->count_orders;?> заданий</span>
        <span><?= $model->count_reviews;?> отзывов</span>
    </div>
    <div class="feedback-card__top--name user__search-card">
        <p class="link-name"><a href="#" class="link-regular"><?=$model->name;?></a></p>
        <? for($i = 0;$i < 5; $i++):
             if($i<$model->rating):
                echo '<span></span>';
             else:
                echo "<span class='star-disabled'></span>";
             endif;
           endfor;?>
      <b><?= round($model->rating, 1);?></b>
        <p class="user__search-content"><?=$model->info;?></p>
    </div>
    <span class="new-task__time">
        <?="Был на сайте ".(new TimeAgo($model->last_visit_time))->getDate();?>
    </span>
</div>
<div class="link-specialization user__search-link--bottom">
    <?php
        foreach ($model->categories as $categoryItem): ?>
        <a href="#" class="link-regular"><?=$categoryItem['title']?></a>
        <?php endforeach; ?>
</div>