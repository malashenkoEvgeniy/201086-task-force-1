<?php

namespace frontend\modules\messages;

/**
 * messages module definition class
 */
class Module extends \yii\base\Module
{
  /**
   * {@inheritdoc}
   */
  public $controllerNamespace = 'frontend\modules\messages\controllers';
  public $layout = 'main';

  /**
   * {@inheritdoc}
   */
  public function init()
  {
    parent::init();
  }
}
