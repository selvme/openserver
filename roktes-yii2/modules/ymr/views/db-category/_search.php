<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\for_category\models\DbCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="db-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'is_menu_item') ?>

    <?php // echo $form->field($model, 'parent_menu_item') ?>

    <?php // echo $form->field($model, 'is_parent') ?>

    <?php // echo $form->field($model, 'meta_desc') ?>

    <?php // echo $form->field($model, 'meta_key') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
