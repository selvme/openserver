<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\for_page\models\DbPageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="db-page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'ttx') ?>

    <?php // echo $form->field($model, 'have_img') ?>

    <?php // echo $form->field($model, 'path_to_video') ?>

    <?php // echo $form->field($model, 'price_dollar') ?>

    <?php // echo $form->field($model, 'is_spec_offer') ?>

    <?php // echo $form->field($model, 'spec_offer_price') ?>

    <?php // echo $form->field($model, 'spec_offer_content') ?>

    <?php // echo $form->field($model, 'have_scan') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'is_block') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
