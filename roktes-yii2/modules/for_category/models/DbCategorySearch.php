<?php

namespace app\modules\for_category\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\for_category\models\DbCategory;

/**
 * DbCategorySearch represents the model behind the search form of `app\modules\for_category\models\DbCategory`.
 */
class DbCategorySearch extends DbCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_menu_item', 'parent_menu_item', 'is_parent'], 'integer'],
            [['title', 'url', 'description', 'meta_desc', 'meta_key', 'meta_title'], 'safe'],
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
        $query = DbCategory::find();

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
            'is_menu_item' => $this->is_menu_item,
            'parent_menu_item' => $this->parent_menu_item,
            'is_parent' => $this->is_parent,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc])
            ->andFilterWhere(['like', 'meta_key', $this->meta_key])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title]);

        return $dataProvider;
    }
}
