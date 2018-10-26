<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\for_page\models\DbPage */
/* @var $form yii\widgets\ActiveForm */
?>

<? foreach ($images as $img) : ?>
    <? $classImg = \yii\helpers\StringHelper::basename(get_class($img)); ?>
    <?php Pjax::begin([
            'enablePushState' => false,
    ]); ?>
        <div class="row" style="margin: 10px 0;">
            <div class="col-md-3">
                <? if ($classImg == "DbImg") : ?>
                    <?= Html::img(Url::home() . $img->path_to_img, ['style' => 'max-height: 200px; max-width: 200px'])?>
                <? else : ?>
                    <?= Html::img(Url::home() . $img->scan_path, ['style' => 'max-height: 200px; max-width: 200px'])?>
                <? endif; ?>
            </div>
            <div class="col-md-9">
                <?php $formParam = ActiveForm::begin([
                    'options' => ['data-pjax' => true],
                    'fieldConfig' => ['template' => "{label}\n{input}",],
                ]); ?>
                <div class="row">
                    <? if ($classImg == "DbImg") : ?>
                        <?= $formParam->field($img, 'img_title')->textInput() ?>
                    <? else : ?>
                        <?= $formParam->field($img, 'scan_title')->textInput() ?>
                    <? endif; ?>
                </div>
                <div class="row">
                    <? if ($classImg == "DbImg") : ?>
                        <?= $formParam->field($img, 'img_alt')->textInput() ?>
                        <?= $formParam->field($img, 'weight')->textInput() ?>
                    <? else : ?>
                        <?= $formParam->field($img, 'scan_alt')->textInput() ?>
                    <? endif; ?>
                </div>
                <?= $formParam->field($img, 'entity_id', ['template' => "{input}"])->hiddenInput() ?>
                <?= $formParam->field($img, 'id', ['template' => "{input}"])->hiddenInput() ?>
                <?= $formParam->field($img, 'path_to_img', ['template' => "{input}"])->hiddenInput() ?>
                <div class="row">
                    <div class="col-md-2">
                        <?= Html::submitButton('ChangeParam', [
                            'class' => 'btn btn-default',
                            'formaction' => 'change-param-img',
                        ]) ?>

                    </div>
                    <div class="col-md-2">
                        <?= Html::submitButton('Delete', ['class' => 'btn btn-danger', 'formaction' => 'del-img']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php Pjax::end(); ?>
<? endforeach; ?>

<div class="db-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
