<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Leader;

/**
 * LeaderSearch represents the model behind the search form of `common\models\Leader`.
 */
class LeaderSearch extends Leader
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'leader_category_id', 'status'], 'integer'],
            [['img', 'name', 'phone', 'email','position','work_day'], 'safe'],
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
        $query = Leader::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes'=>['name','leader_category_id','status','name','phone','email','position','work_day']]
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
            'leader_category_id' => $this->leader_category_id,
            'status' => $this->status,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);
        $query->joinWith('translations');
        $query->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'work_day', $this->work_day])
            ->andFilterWhere(['like', 'biography', $this->biography]);

        return $dataProvider;
    }
}
