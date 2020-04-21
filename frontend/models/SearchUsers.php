<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Users;

/**
 * SearchUsers represents the model behind the search form of `frontend\models\Users`.
 */
class SearchUsers extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'location_id', 'show_contacts_for_customer', 'hide_profile'], 'integer'],
            [['creation_time', 'name', 'email', 'birthday', 'info', 'password', 'phone', 'skype', 'another_messenger', 'avatar', 'task_name', 'last_visit_time'], 'safe'],
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
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'creation_time' => $this->creation_time,
            'location_id' => $this->location_id,
            'birthday' => $this->birthday,
            'show_contacts_for_customer' => $this->show_contacts_for_customer,
            'hide_profile' => $this->hide_profile,
            'last_visit_time' => $this->last_visit_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'another_messenger', $this->another_messenger])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'task_name', $this->task_name]);

        return $dataProvider;
    }
}
