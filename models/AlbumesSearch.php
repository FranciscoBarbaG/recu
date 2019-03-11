<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AlbumesSearch represents the model behind the search form of `app\models\Albumes`.
 */
class AlbumesSearch extends Albumes
{
    public $duraciontotal;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['titulo', 'duraciontotal'], 'safe'],
            [['anyo'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'duraciontotal',
        ]);
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Albumes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['duraciontotal'] = [
            'asc' => ['duraciontotal' => SORT_ASC],
            'desc' => ['duraciontotal' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'anyo' => $this->anyo,
            'duraciontotal' => $this->duraciontotal,
        ]);

        $query->andFilterWhere(['ilike', 'titulo', $this->titulo]);

        return $dataProvider;
    }
}
