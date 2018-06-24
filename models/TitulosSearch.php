<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Titulos;

/**
 * TitulosSearch represents the model behind the search form of `app\models\Titulos`.
 */
class TitulosSearch extends Titulos {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'atualizacao_id', 'categoria_id'], 'integer'],
            [['ativo', 'emissor', 'taxa'], 'safe'],
            [['quantidade', 'tributos', 'valor_compra', 'valor_venda'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Titulos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
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
            'quantidade' => $this->quantidade,
            'tributos' => $this->tributos,
            'valor_compra' => $this->valor_compra,
            'valor_venda' => $this->valor_venda,
            'atualizacao_id' => $this->atualizacao_id,
            'categoria_id' => $this->categoria_id,
        ]);

        $query->andFilterWhere(['ilike', 'ativo', $this->ativo])
                ->andFilterWhere(['ilike', 'emissor', $this->emissor])
                ->andFilterWhere(['ilike', 'taxa', $this->emissor]);

        return $dataProvider;
    }

}
