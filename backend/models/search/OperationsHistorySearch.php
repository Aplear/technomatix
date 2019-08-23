<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OperationsHistory;
use yii\db\ActiveQuery;

/**
 * OperationsHistorySearch represents the model behind the search form of `backend\models\OperationsHistory`.
 */
class OperationsHistorySearch extends OperationsHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'created_at', 'updated_at', 'owner_id'], 'integer'],
            [['model'], 'string'],
            [['operation'], 'safe'],
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
        $query = OperationsHistory::find();

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
            'model_id' => $this->model_id,
            'owner_id' => $this->owner_id,
            'model' => $this->model,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'operation', $this->operation]);

        /** @var $query ActiveQuery */
        $query->select([
            OperationsHistory::tableName() . '.owner_id',
            OperationsHistory::tableName() . '.model',
            OperationsHistory::tableName() . '.model_id',
            OperationsHistory::tableName() . '.operation',
            OperationsHistory::tableName() . '.created_at',
        ]);

        return $dataProvider;
    }
}
