<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * UsersSearch represents the model behind the search form of `frontend\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'location_id', 'show_contacts_for_customer', 'hide_profile', 'count_orders', 'popularity', 'now_free', 'has_reviews', 'is_executor', 'count_reviews', 'rating', 'status', 'created_at', 'updated_at'], 'integer'],
            [['creation_time', 'name', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'birthday', 'info', 'phone', 'skype', 'another_messenger', 'avatar', 'task_name', 'last_visit_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
		{
			$users = Users::find()->all();

			foreach ($users as $user){
				$assessments = 0;
				$user->rating = 0;
				$user->count_orders = count($user->executorTasks);
				foreach ($user->executorReviews as $v){
					$assessments +=  $v['assessment'];
				}
				$user->has_reviews = 0;
				$user->count_reviews = count($user->executorReviews);
				if($user->count_reviews > 0){
					$user->rating =  round($assessments / $user->count_reviews * 100, 0);
					$user->has_reviews = 0;
				}

				foreach($user->executorTasks as $v){
					if($v['status']==2){
						$user->now_free = 0;
					} else {
						$user->now_free = 1;
					}
				}
				if(count($user->categories) > 0){
					$user->is_executor = 1;
				}
				$user->save();
			}




			$query = Users::find()
				->joinWith('categories');

			// add conditions that should always apply here

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'Pagination' => [
					'pageSize' =>5,

				],
				'sort'=>[
					'attributes'=>[
						'rating' => [
							'asc' => ['rating' => SORT_ASC],
							'desc' => ['rating' => SORT_DESC],
							'label' => 'Рейтингу',
							'class' => 'link-regular'
						],
						'count_orders' => [
							'asc' => ['count_orders' => SORT_ASC],
							'desc' => ['count_orders' => SORT_DESC],
							'label' => 'Числу заказов',
							'class' => 'link-regular'
						],
						'popularity' => [
							'asc' => ['popularity' => SORT_ASC],
							'desc' => ['popularity' => SORT_DESC],
							'label' => 'Популярности',
							'class' => 'link-regular'
						],
						'creation_time',
						'is_executor'
					],
				]
			]);
			$dataProvider->sort->defaultOrder['creation_time']=['date' => SORT_DESC];

			$this->load($params);

			if (!$this->validate()) {
				// uncomment the following line if you do not want to return any records when validation fails
				// $query->where('0=1');
				return $dataProvider;
			}
			$this->is_executor = 1;
			// grid filtering conditions
			$query->andFilterWhere([
				'id' => $this->id,
				'creation_time' => $this->creation_time,
				'location_id' => $this->location_id,
				'birthday' => $this->birthday,
				'show_contacts_for_customer' => $this->show_contacts_for_customer,
				'hide_profile' => $this->hide_profile,
				'last_visit_time' => $this->last_visit_time,
				'rating' => $this->rating,
				'count_orders' => $this->count_orders,
				'popularity' => $this->popularity,
				'now_free' => $this->now_free,
				'has_reviews' => $this->has_reviews,
				'is_executor' => $this->is_executor,
				'count_reviews' => $this->count_reviews,

				//->where(['is_executor'=>1])
			]);

			$query->andFilterWhere(['like', 'name', $this->name])
				->andFilterWhere(['like', 'email', $this->email])
				->andFilterWhere(['like', 'info', $this->info])
				->andFilterWhere(['like', 'password_hash', $this->password_hash])
				->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
				->andFilterWhere(['like', 'phone', $this->phone])
				->andFilterWhere(['like', 'skype', $this->skype])
				->andFilterWhere(['like', 'another_messenger', $this->another_messenger])
				->andFilterWhere(['like', 'avatar', $this->avatar])
				->andFilterWhere(['like', 'categories.id', $this->categories])
				->andFilterWhere(['like', 'task_name', $this->task_name]);

			return $dataProvider;
		}
}
