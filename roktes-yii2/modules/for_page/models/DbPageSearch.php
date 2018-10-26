<?php

namespace app\modules\for_page\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\for_page\models\DbPage;

/**
 * DbPageSearch represents the model behind the search form of `app\modules\for_page\models\DbPage`.
 */
class DbPageSearch extends DbPage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'category_id', 'status', 'have_img', 'price_dollar', 'is_spec_offer', 'spec_offer_price', 'have_scan', 'is_block', 'weight'], 'integer'],
            [['url', 'title', 'description', 'content', 'ttx', 'path_to_video', 'spec_offer_content', 'city', 'date', 'meta_title', 'meta_desc', 'meta_key'], 'safe'],
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
        $query = DbPage::find();

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
            'type' => $this->type,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'have_img' => $this->have_img,
            'price_dollar' => $this->price_dollar,
            'is_spec_offer' => $this->is_spec_offer,
            'spec_offer_price' => $this->spec_offer_price,
            'have_scan' => $this->have_scan,
            'date' => $this->date,
            'is_block' => $this->is_block,
            'weight' => $this->weight,
            'meta_title' => $this->meta_title,
            'meta_desc' => $this->meta_desc,
            'meta_key' => $this->meta_key,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'ttx', $this->ttx])
            ->andFilterWhere(['like', 'path_to_video', $this->path_to_video])
            ->andFilterWhere(['like', 'spec_offer_content', $this->spec_offer_content])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
