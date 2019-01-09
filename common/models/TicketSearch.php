<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ticket;

/**
 * TicketSearch represents the model behind the search form of `common\models\Ticket`.
 */
class TicketSearch extends Ticket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stream_id', 'media_id', 'user_type'], 'integer'],
            [['response', 'created_at'], 'safe'],
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
        $query = Ticket::find();

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
            'stream_id' => $this->stream_id,
            'media_id' => $this->media_id,
            'user_type' => $this->user_type,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'response', $this->response]);

        return $dataProvider;
    }
}
