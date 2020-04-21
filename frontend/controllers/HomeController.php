<?php


namespace frontend\controllers;


class HomeController extends AppController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}