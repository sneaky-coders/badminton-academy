<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Court;

/**
 * SearchCourt represents the model behind the search form of `app\models\Court`.
 */
class SearchCourt extends Court
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'adults', 'children', 'young_children'], 'integer'],
            [['name', 'email', 'contact', 'address', 'date', 'starttime', 'endtime', 'created_at', 'updated_at'], 'safe'],
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
        $query = Court::find();

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
            'adults' => $this->adults,
            'children' => $this->children,
            'young_children' => $this->young_children,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'starttime', $this->starttime])
            ->andFilterWhere(['like', 'endtime', $this->endtime]);

        return $dataProvider;
    }
}
