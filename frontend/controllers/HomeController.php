<?php


namespace frontend\controllers;


use common\models\LoginForm;
use Yii;

class HomeController extends AppController
{
	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render('index', [
				'model' => $model,
			]);

		}
	}
}