<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TaskSearch represents the model behind the search form of `frontend\models\AvailableActions`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'location_id', 'budget', 'customer_id', 'executor_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'deadline', 'status'], 'safe'],
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
        $query = Task::find()
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
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'budget' => $this->budget,
            'deadline' => $this->deadline,
            'customer_id' => $this->customer_id,
            'executor_id' => $this->executor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
