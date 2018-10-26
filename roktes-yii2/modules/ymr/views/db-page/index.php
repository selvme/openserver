<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\for_page\models\DbPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Db Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Db Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',

            'title',
            'type',
            'category_id',
            'status',
            'url:url',
            //'description:ntext',
            //'content:ntext',
            //'ttx:ntext',
            //'have_img',
            //'path_to_video',
            //'price_dollar',
            //'is_spec_offer',
            //'spec_offer_price',
            //'spec_offer_content:ntext',
            //'have_scan',
            //'city',
            //'date',
            //'is_block',
            //'weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
