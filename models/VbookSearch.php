<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vbook;

/**
 * VbookSearch represents the model behind the search form about `app\models\Vbook`.
 */
class VbookSearch extends Vbook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['book_no', 'book_date', 'book_name', 'book_detail', 'ref', 'book_photo', 'create_at', 'update_at', 'docs'], 'safe'],
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
        $query = Vbook::find();

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
            'book_date' => $this->book_date,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'book_no', $this->book_no])
            ->andFilterWhere(['like', 'book_name', $this->book_name])
            ->andFilterWhere(['like', 'book_detail', $this->book_detail])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'book_photo', $this->book_photo])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        return $dataProvider;
    }
}
