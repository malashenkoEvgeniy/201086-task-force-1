<?php

namespace frontend\controllers;

use frontend\models\Categories;
use frontend\models\Proposal;
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
	public $countTask;
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
				$query = Tasks::find()->with('category')->with('location')->with('customer');
				$pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=> 5, 'forcePageParam'=>false, 'pageSizeParam'=>false]);
				$tasks = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();


				$model = new SearchForm();
			return $this->render('index', compact( 'tasks', 'pages', 'model', 'categories'));
    }

    public function actionSearch()
		{
			$arr = [];
			$q = explode("&", trim(\Yii::$app->request->queryString));
			$i =0;
			foreach ($q as $itemQuery){
				$arr[$i] = explode('=', $itemQuery);
				$i++;
			}
			$categories = Categories::find()->indexBy('id')->all();
			$query = Tasks::find();
			$arrCat = [];
			foreach ($arr as $arrItem) {
				if($arrItem[0]==='time') {
					switch ($arrItem[1]){
						case 'month':
							$toDate = date('Y-m-d H:i:s', strtotime('1 months ago'));
							break;
						case 'week':
							$toDate = date('Y-m-d H:i:s', strtotime('-1 weeks'));
							break;
						case 'day':
							$toDate = date('Y-m-d H:i:s', strtotime('today'));
							break;
					}
				}
			}
			$query->andFilterCompare('tasks.creation_time', ">$toDate");

			if(!empty($arrCat)){
				$query->andWhere(['like', 'category_id', $arrCat]);
			}
			for ($i=1; $i<count($arr); $i++){
				foreach ($categories as $category) {
					if ($arr[$i][0] === $category->title_en) {
						array_push($arrCat, $category->id);
					}
				}
				if($arr[$i][0]==='search-word'&& $arr[$i][1]!=='') {
					$query->andWhere(['like', 'name', $arr[$i][1]]);
				}
				if($arr[$i][0]==='teleworking') {
					$query->andWhere(['location_id' => null]);
				}

				if($arr[$i][0]==='response') {
					//foreach ($query->all() as $item){
						//foreach(Proposal::find()->all() as $valProposal){}
//}
					//foreach ($query as $val){
//						debug($val['proposals']);
					//}
				}

			}

			//debug($query->all());
			if(!empty($arrCat)){
				$query->andWhere(['like', 'category_id', $arrCat]);
			}

			$query->with('category')->with('location')->with('customer');
			//$this->countTask = $query->count();
			//echo $this->countTask;
			//debug($query);
			$pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=> 5, 'forcePageParam'=>false, 'pageSizeParam'=>false]);
			$tasks = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
			$model = new SearchForm();
			//debug($tasks);
			return $this->render('index', compact( 'tasks', 'pages', 'model', 'categories'));
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
