<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\for_category\models\DbCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="db-category-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id')->textInput()->hiddenInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_menu_item')->dropDownList(
        ArrayHelper::map($item_menu, 'id', 'name'),
        [
            'prompt' => 'Категория меню',
        ]
    ) ?>

    <?= $form->field($model, 'is_menu_item')->checkbox() ?>

    <?= $form->field($model, 'meta_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_key')->textInput() ?>

    <?= $form->field($model, 'meta_title')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
