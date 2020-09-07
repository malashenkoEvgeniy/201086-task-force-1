<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//use frontend\models\Tasks;

/**
 * TasksSearch represents the model behind the search form of `frontend\models\Tasks`.
 */
class TasksSearch extends Tasks
{
	public $category;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'location_id', 'budget', 'customer_id', 'executor_id', 'status'], 'integer'],
            [['creation_time', 'name', 'description', 'deadline' , 'category'], 'safe'],
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
        $query = Tasks::find()
					->joinWith('category')
					->joinWith('location')
					->andWhere(['status'=>0]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
						'Pagination' => [
							'pageSize' =>5,

						],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'creation_time' => $this->creation_time,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'budget' => $this->budget,
            'deadline' => $this->deadline,
            'customer_id' => $this->customer_id,
            'executor_id' => $this->executor_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
					->andFilterWhere(['and', ['>', 'creation_time', date('Y-m-d H:i:s',$this->creation_time)]])

					->andFilterWhere(['like', 'categories.id', $this->category]);

        return $dataProvider;
    }
}
