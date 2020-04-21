<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChatMessages;

/**
 * ChatMessagesSearch represents the model behind the search form of `app\models\ChatMessages`.
 */
class ChatMessagesSearch extends ChatMessages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'writer_id', 'viewed'], 'integer'],
            [['comment', 'creation_time'], 'safe'],
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
        $query = ChatMessages::find();

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
            'task_id' => $this->task_id,
            'writer_id' => $this->writer_id,
            'creation_time' => $this->creation_time,
            'viewed' => $this->viewed,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
