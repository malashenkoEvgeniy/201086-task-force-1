<?php

namespace frontend\controllers;

use frontend\models\Categories;
use frontend\models\SearchForm;
use Throwable;
use Yii;
use frontend\models\Tasks;

use yii\data\Pagination;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends AppController
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
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {

        $categories = Categories::find()->indexBy('id')->all();


				//$tasks = Tasks::find()->with('category')->with('location')->with('customer')->asArray()->all();
				$query = Tasks::find()->with('category')->with('location')->with('customer');
				$pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=> 5, 'forcePageParam'=>false, 'pageSizeParam'=>false]);
				$tasks = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
				$model = new SearchForm();
			return $this->render('index', compact( 'tasks', 'pages', 'model', 'categories'));
    }

    public function actionSearch()
		{
			$q = trim(\Yii::$app->request->get('q'));

			return $this->render('search', compact('q'));

		}

    /**
     * Displays a single Tasks model.
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
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tasks model.
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
     * Deletes an existing Tasks model.
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
			} catch (Throwable $e) {
			}

			return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
