<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * UsersSearch represents the model behind the search form of `frontend\models\Users`.
 */
class UsersSearch extends Users
{
		public $categories;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'location_id', 'show_contacts_for_customer', 'hide_profile', 'rating', 'count_orders', 'popularity', 'now_free', 'has_reviews', 'is_executor', 'count_reviews'], 'integer'],
            [['creation_time', 'name', 'email', 'birthday', 'info', 'password', 'phone', 'skype', 'another_messenger', 'avatar', 'task_name', 'last_visit_time', 'categories'], 'safe'],
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
        $query = Users::find()
					->joinWith('categories')
					->where(['is_executor'=>1]);

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
				//$dataProvider->sort->defaultOrder['is_executor'=>1];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'another_messenger', $this->another_messenger])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
						->andFilterWhere(['like', 'categories.id', $this->categories])
            ->andFilterWhere(['like', 'task_name', $this->task_name]);

        return $dataProvider;
    }
}
