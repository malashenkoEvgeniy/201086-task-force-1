
                <? //foreach ($newUser as $item): ?>
<div class="content-view__feedback-card user__search-wrapper">
	<div class="feedback-card__top">
		<div class="user__search-icon">
			<a href="#"><img src="<?php // $item['avatar'];?>" width="65" height="65" alt=""></a>
			<span><? // $item['count-tasks'];?> заданий</span>
			<span><? // $item['count-reviews'];?> отзывов</span>
		</div>
		<div class="feedback-card__top--name user__search-card">
			<p class="link-name"><a href="#" class="link-regular"><?php // $item['name'];?></a></p>
			<? /*for($i = 0;$i < 5; $i++):
                                                if($i<=$item['assessment-stars']):
                                                    echo '<span></span>';
                                                else:
                                                    echo "<span class='star-disabled'></span>";
                                                endif; endfor;?>
                      <b><?= round($item['count-assessment'], 1);?></b>
                      <p class="user__search-content"><?= $item['info'];?></p>
                  </div>
                  <span class="new-task__time"><?="Был на сайте ".(new TimeAgo($item['last_visit_time']))->getDate();?></span>
              </div>
              <div class="link-specialization user__search-link--bottom">
                                    <?php foreach($item['categories'] as $itemCategory): ?>
                    <a href="#" class="link-regular"><?= $itemCategory;?></a>
                                    <?php endforeach;?>
              </div>
          </div>
                <?php endforeach; ?>
        <div class="new-task__pagination">

                        <?= LinkPager::widget(['pagination'=>$pages,
                            'pageCssClass' => 'pagination__item',
                            'nextPageCssClass' =>'pagination__item',
                            'prevPageCssClass' =>'pagination__item',
                            'activePageCssClass' => 'pagination__item--current',
                            'hideOnSinglePage'=> true,
                            'maxButtonCount' => 3,
                            'options' => ['class' => 'new-task__pagination-list'],
                            'nextPageLabel' => '&#8195',
                            'prevPageLabel' => '&#8195'
                        ]);*/
			?>
		</div>

		</section>
		<section  class="search-task">
			<div class="search-task__wrapper">
				<? /*$form = ActiveForm::begin([
                            'id'=>'tasks-form',
                            'method'=>'get',
                            'action'=>'?r=tasks/search',
                            'options'=> ['class'=>'search-task__form',
                                'name'=>'q']
                        ]) ;*/?>
				<fieldset class="search-task__categories">
					<legend>Категории</legend>
					<?// foreach($categories as $category): ?>
                                    <?// echo  Html::checkbox($category->title_en, false,['class'=>'visually-hidden checkbox__input',                        'id'=>$category->id]);
					//echo Html::label($category->title,$category->id)?>
                                <?// endforeach;?>
				</fieldset>
				<fieldset class="search-task__categories">
					<legend>Дополнительно</legend>
					<? //echo  Html::checkbox('now-free', false,['class'=>'visually-hidden checkbox__input','id'=>count($categories)+1]);
					//echo Html::label('Сейчас свободен',count($categories)+1)?>
                    <? //echo  Html::checkbox('online-now', false,['class'=>'visually-hidden checkbox__input',
					// 'id'=>count($categories)+2]);
					//cho //Html::label('Сейчас онлайн' ,count($categories)+2)?>
                    <? //echo  Html::checkbox('there-are-reviews', false,['class'=>'visually-hidden checkbox__input',
					// 'id'=>count($categories)+3]);
					//echo Html::label('Есть отзывы' ,count($categories)+3)?>
                    <? //echo  Html::checkbox('in-favorites', false,['class'=>'visually-hidden checkbox__input',
					// 'id'=>count($categories)+4]);
					//echo Html::label('В избранном' ,count($categories)+4)?>
				</fieldset>
				<? /* Html::label('Поиск по имени' ,count($categories)+5,
                            [ 'class'=>'search-task__name']) ?>
                        <?= Html::tag('input' ,'',
                            [ 'class'=>'input-middle input',
                                'id'=>count($categories)+5,
                                'type'=>'search',
                                'name'=>'search-word']) ?>
                        <?= Html::submitButton('Искать', ['class'=>'button']);?>
                        <?php ActiveForm::end() ;*/?>
			</div>
		</section>
	</div>


</div>
