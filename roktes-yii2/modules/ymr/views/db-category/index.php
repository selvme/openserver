<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\for_category\models\DbCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Db Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Db Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'url:url',
//            'description:ntext',
            'is_menu_item',
            //'parent_menu_item',
            //'is_parent',
            'meta_desc:ntext',
            'meta_key:ntext',
            'meta_title:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
