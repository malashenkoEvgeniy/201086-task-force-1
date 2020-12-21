<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Account;
use frontend\models\Categories;
use frontend\models\UsersCategories;
use Yii;
use yii\web\Controller;


class AccountController extends Controller
{
  public $layout = 'main';


  public function actionView($id)
  {
    $model = User::find()->where(['id' => $id])->one();
    $categories = Categories::find()->asArray()->all();
    $userCategories = UsersCategories::find()->where(['user_id' => $id])
      ->joinWith(['category'])->all();
    $account = new Account();


    if ($model->load(Yii::$app->request->post())) {
      $post = Yii::$app->request->post();
      //debug($post);
    }

    return $this->render('view', [
      'model' => $model,
      'categories' => $categories,
      'userCategories' => $userCategories,
      'account' => $account
    ]);
  }


}
