<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<div class="row" style="border-bottom: 1px dotted #333">
    <div class="col-md-6" style="border-right: 1px dotted #333">
        <h2 style="margin-bottom: 40px">Дополнительные характеристики:</h2>
        <?if (!empty($addCh)) : ?>
            <? foreach ($addCh as $ch) : ?>
                <?php Pjax::begin([
                    'enablePushState' => false,
                ]); ?>
                <?php $formParam = ActiveForm::begin([
                    'options' => ['data-pjax' => true],
                    'fieldConfig' => ['template' => "{label}\n{input}",],
                ]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $formParam->field($ch, 'name')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $formParam->field($ch, 'value')->textInput() ?>
                    </div>
                    <div class="col-md-4" style="margin-top: 25px">
                        <?= Html::submitButton('Change', [
                            'class' => 'btn btn-default',
                            'formaction' => 'change-param',
                        ]) ?>
                        <?= Html::submitButton('Delete', ['class' => 'btn btn-danger', 'formaction' => 'del-param', 'formnovalidate' => true]) ?>
                    </div>
                    <?= $formParam->field($ch, 'id', ['template' => "{input}"])->hiddenInput() ?>
                    <?= $formParam->field($ch, 'product_id', ['template' => "{input}"])->hiddenInput() ?>
                </div>

                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>
            <? endforeach; ?>
        <? endif; ?>
    </div>
    <div class="col-md-6">
        <h2 style="margin-bottom: 40px">Основные характеристики:</h2>
        <?if (!empty($mainCh)) : ?>
            <? foreach ($mainCh as $ch) : ?>
                <?php Pjax::begin([
                    'enablePushState' => false,
                ]); ?>
                    <?php $formParam = ActiveForm::begin([
                        'options' => ['data-pjax' => true],
                        'fieldConfig' => ['template' => "{label}\n{input}",],
                    ]); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $formParam->field($ch, 'name')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $formParam->field($ch, 'value')->textInput() ?>
                            </div>
                            <div class="col-md-4" style="margin-top: 25px">
                                <?= Html::submitButton('Change', [
                                    'class' => 'btn btn-default',
                                    'formaction' => 'change-param',
                                ]) ?>
                                <?= Html::submitButton('Delete', ['class' => 'btn btn-danger', 'formaction' => 'del-param']) ?>
                            </div>
                            <?= $formParam->field($ch, 'id', ['template' => "{input}"])->hiddenInput() ?>
                            <?= $formParam->field($ch, 'product_id', ['template' => "{input}"])->hiddenInput() ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>
            <? endforeach; ?>
        <? endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php $formAdd = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-4">
                <?= $formAdd->field($newAddCh, 'name')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $formAdd->field($newAddCh, 'value')->textInput() ?>
            </div>
            <div class="col-md-4" style="margin-top: 25px">
                <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?= $formAdd->field($newAddCh, 'product_id', ['template' => "{input}"])->hiddenInput(['default', 'value' => $model->id]) ?>
        <?= $formAdd->field($newAddCh, 'isNewRecord', ['template' => "{input}"])->hiddenInput(['default', 'value' => 'true']) ?>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-6">
        <?php $formMain = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-4">
                <?= $formMain->field($newMainCh, 'name')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $formMain->field($newMainCh, 'value')->textInput() ?>
            </div>
            <?= $formMain->field($newMainCh, 'product_id', ['template' => "{input}"])->hiddenInput(['value' => $model->id]) ?>
            <?= $formMain->field($newMainCh, 'id', ['template' => "{input}"])->hiddenInput(['default', 'value' => null]) ?>

            <div class="col-md-4" style="margin-top: 25px">
                <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
