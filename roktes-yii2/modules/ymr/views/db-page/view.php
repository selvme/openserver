<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\for_page\models\DbPage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Db Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$typeOfPage = $model->getTypeName()->one()->name;
?>
<div class="db-page-view">

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
        <? if ($typeOfPage == 'products') : ?>
            <?= Html::a('Change Images', [
                'upload', 'id' => $model->id,
                'type_page' => $typeOfPage,
                'type_upload' => 'img'
            ],
                ['class' => 'btn btn-default']) ?>
            <?= Html::a('Change Parameters', [
                'show-params', 'id' => $model->id,
            ],
                ['class' => 'btn btn-default']) ?>
        <? endif; ?>
        <? if ($typeOfPage == 'reviews') : ?>
            <?= Html::a('Upload Scan', [
                'upload', 'id' => $model->id,
                'type_upload' => 'scan'
            ],
                ['class' => 'btn btn-default']) ?>
            <?= Html::a('Upload Image', [
                'upload', 'id' => $model->id,
                'type_upload' => 'img'
            ],
                ['class' => 'btn btn-default']) ?>
        <? endif; ?>
        <? if ($typeOfPage == 'news') : ?>
            <?= Html::a('Upload Image', [
                'upload', 'id' => $model->id,
                'type_page' => $typeOfPage,
                'type_upload' => 'img'
            ],
                ['class' => 'btn btn-default']) ?>
        <? endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'category_id',
            'status',
            'url:url',
            'title',
            'description:ntext',
            'content:ntext',
            'ttx:ntext',
            'path_to_video',
            'price_dollar',
            'is_spec_offer',
            'spec_offer_price',
            'spec_offer_content:ntext',
            'have_scan',
            'city',
            'date',
            'is_block',
            'weight',
            'meta_desc',
            'meta_key',
            'meta_title',
        ],
    ]) ?>

</div>
