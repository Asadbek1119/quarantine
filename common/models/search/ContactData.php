<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactData as ContactDataModel;

/**
 * ContactData represents the model behind the search form of `common\models\ContactData`.
 */
class ContactData extends ContactDataModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['address', 'destination', 'email', 'phone_first', 'lunch_time', 'download'], 'safe'],
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
        $query = ContactDataModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['address', 'destination', 'email', 'phone_first', 'lunch_time', 'download']]
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
        ]);
        $query->joinWith('translations');
        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone_first', $this->phone_first])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'lunch_time', $this->lunch_time])
            ->andFilterWhere(['like', 'download', $this->download]);

        return $dataProvider;
    }
}
