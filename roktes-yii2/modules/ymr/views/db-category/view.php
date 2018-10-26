<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\for_category\models\DbCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Db Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'url:url',
            'description:ntext',
            'is_menu_item',
            'parent_menu_item',
            'is_parent',
            'meta_desc:ntext',
            'meta_key:ntext',
            'meta_title:ntext',
        ],
    ]) ?>

</div>
