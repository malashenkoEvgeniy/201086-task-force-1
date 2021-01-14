<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;

/**
 * Default controller for the `api1` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return __DIR__ . '/config/main.php';
    }
}
