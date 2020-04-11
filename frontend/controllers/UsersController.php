<?php

namespace frontend\controllers;

use frontend\models\Reviews;
use frontend\models\Tasks;
use frontend\models\UsersCategories;
use Yii;
use frontend\models\Users;
use frontend\models\SearchUsers;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUsers();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$users = Users::find()
				->with('location')
				->asArray()->all();
			$reviews = Reviews::find()->asArray()->all();
			$tasks = Tasks::find()->asArray()->all();
			$usersCategories = UsersCategories::find()->with('category')->asArray()->all();
			$i = 0;
			foreach ($users as $user) {
				$count = ['count-reviews'=> 0,
									'count-tasks' => 0,
									'count-assessment' => 0,
									'divider-assessment' => 0,
									'categories' => []];
				foreach ($reviews as $review){
					if($review['executor_id'] === $user['id']){
						$count['count-reviews'] ++;
						$count['count-assessment'] += $review['assessment'];
						$count['divider-assessment'] ++;
					}
				}
				if($count['divider-assessment']===0){
					$count['divider-assessment'] = 1;
				}
				$count['count-assessment'] = $count['count-assessment'] / $count['divider-assessment'];
				$count['assessment-stars'] = round($count['count-assessment']);
				foreach ($tasks as $task){
					if($task['executor_id'] === $user['id']){
						$count['count-tasks'] ++;
					}
				}
				foreach ($usersCategories as $categories){
					if($categories['user_id'] === $user['id']){
						array_push($count['categories'], $categories['category']['title']);
					}
				}
				$newUser[$i] = array_merge($user, $count);
				$i++;
			}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
						'newUser' => $newUser,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
			try {
				$this->findModel($id)->delete();
			} catch (StaleObjectException $e) {
			} catch (NotFoundHttpException $e) {
			} catch (\Throwable $e) {
			}

			return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
