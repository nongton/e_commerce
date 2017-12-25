<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ReportSearch represents the model behind the search form about `common\models\Stock`.
 */
class ReportSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id'], 'integer'],
            [['productName', 'productDetail', 'productQuantity','productType','photo'], 'string'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Product::find();

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
            'Id' => $this->Id,
            'productName' => $this->productName,
            'photo' => $this->photo,
            'productDetail' => $this->productDetail,
            'productPrice' => $this->productPrice,
            'productQuantity' => $this->productQuantity,
            'productType' => $this->productType,
        ]);

        $query->andFilterWhere(['like', 'productName', $this->productName])
        ->andFilterWhere(['like', 'productPrice', $this->productPrice]);

        return $dataProvider;
    }
}
