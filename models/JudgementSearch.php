<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Judgement;

/**
 * JudgementSearch represents the model behind the search form about `app\models\Judgement`.
 */
class JudgementSearch extends Judgement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'file_size', 'transfer_status', 'file_page'], 'integer'],
            [['black_number', 'doc_type_id', 'black_append', 'red_number', 'doc_style_id', 'file_name', 'scan_by', 'scan_datetime', 'upload_by', 'upload_datetime', 'create_at'], 'safe'],
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
        $query = Judgement::find();

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
            'file_size' => $this->file_size,
            'transfer_status' => $this->transfer_status,
            'file_page' => $this->file_page,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'black_number', $this->black_number])
            ->andFilterWhere(['like', 'doc_type_id', $this->doc_type_id])
            ->andFilterWhere(['like', 'black_append', $this->black_append])
            ->andFilterWhere(['like', 'red_number', $this->red_number])
            ->andFilterWhere(['like', 'doc_style_id', $this->doc_style_id])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'scan_by', $this->scan_by])
            ->andFilterWhere(['like', 'scan_datetime', $this->scan_datetime])
            ->andFilterWhere(['like', 'upload_by', $this->upload_by])
            ->andFilterWhere(['like', 'upload_datetime', $this->upload_datetime]);

        return $dataProvider;
    }
}
