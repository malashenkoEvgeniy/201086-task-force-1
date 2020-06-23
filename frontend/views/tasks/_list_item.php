<?php

use frontend\classes\TimeAgo;
use yii\helpers\Url;

?>
<div class="new-task__card">
	<div class="new-task__title">
		<a href="<?=Url::to(['tasks/view', 'id' => $model->id]);?>" class="link-regular"><h2><?=$model->name;?></h2></a>
		<a  class="new-task__type link-regular" href="#">
            <p><?=$model->category->title?></p>
        </a>
	</div>
	<div class="new-task__icon new-task__icon--<?=$model->category->title_en?>"></div>
	<p class="new-task_description">
			<?=$model->description?>
	</p>
	<b class="new-task__price new-task__price--translation">
      <?=$model->budget?><b> ₽</b>
    </b>
	<p class="new-task__place"><?=$model->location->city?></p>
	<span class="new-task__time"><?= (new TimeAgo($model->creation_time))->getDate(); ?> назад</span>
</div>