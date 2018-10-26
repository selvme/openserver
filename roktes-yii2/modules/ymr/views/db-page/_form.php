<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\for_page\models\DbPage */
/* @var $form yii\widgets\ActiveForm */
$type = $model->getTypeName()->one()->name;
?>

<div class="db-page-form">

    <?php $form = ActiveForm::begin(); ?>
    <? if ($type == "products") : ?>
        <?= $form->field($model, 'type')->dropDownList(
            ArrayHelper::map($types, 'id', 'name'),
            [
                'prompt' => 'Выбор типа страницы',
            ]
        ) ?>

        <?= $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map($cats, 'id', 'title'),
            [
                'prompt' => 'Выбор категории',
            ]
        ) ?>

        <?= $form->field($model, 'status')->dropDownList(
            [
                '0' => 'Снято с публикации',
                '1' => 'Опубликованно',
            ],
            [
                'prompt' => 'Укажите статус страницы',
            ]
        ) ?>

        <?= $form->field($model, 'url')->textInput(['placeholder' => 'catalog/{url-category}/{url-page}']) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    'advlist autolink lists link charmap  print hr preview pagebreak',
                    'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                    'save insertdatetime media table contextmenu template paste image'
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                'external_filemanager_path' => '/plugins/responsive_filemanager/filemanager/',
                'filemanager_title' => 'Responsive Filemanager',
                'external_plugins' => [
                    'filemanager' => '/plugins/responsive_filemanager/filemanager/plugin.min.js',
                    'responsivefilemanager' => '/plugins/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                ],
            ]
        ]);?>

        <?= $form->field($model, 'ttx')->textarea(['rows' => 6, 'placeholder' => 'Необходим только для Products']) ?>

        <?= $form->field($model, 'path_to_video')->textInput(['maxlength' => true, 'placeholder' => 'YouTube Видео']) ?>

        <?= $form->field($model, 'price_dollar')->textInput() ?>

        <?= $form->field($model, 'is_spec_offer')->checkbox() ?>

        <?= $form->field($model, 'spec_offer_price')->textInput() ?>

        <?= $form->field($model, 'spec_offer_content')->textarea(['rows' => 6, 'placeholder' => 'Контент для страницы Акций']) ?>

        <?= $form->field($model, 'is_block')->textInput() ?>

        <?= $form->field($model, 'weight')->textInput() ?>

        <?= $form->field($model, 'meta_desc')->textInput() ?>

        <?= $form->field($model, 'meta_key')->textInput() ?>

        <?= $form->field($model, 'meta_title')->textInput() ?>

    <? elseif ($type == "articles" || $type == "news") : ?>

        <?= $form->field($model, 'type')->dropDownList(
            ArrayHelper::map($types, 'id', 'name'),
            [
                'prompt' => 'Выбор типа страницы',
            ]
        ) ?>

        <?= $form->field($model, 'status')->dropDownList(
            [
                '0' => 'Снято с публикации',
                '1' => 'Опубликованно',
            ],
            [
                'prompt' => 'Укажите статус страницы',
            ]
        ) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true], ['placeholder' => 'catalog/{url-category}/{url-page}']) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => 'Необходим только для News']) ?>

        <?= $form->field($model, 'content')->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    'advlist autolink lists link charmap  print hr preview pagebreak',
                    'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                    'save insertdatetime media table contextmenu template paste image'
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                'external_filemanager_path' => '/plugins/responsive_filemanager/filemanager/',
                'filemanager_title' => 'Responsive Filemanager',
                'external_plugins' => [
                    'filemanager' => '/plugins/responsive_filemanager/filemanager/plugin.min.js',
                    'responsivefilemanager' => '/plugins/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                ],
            ]
        ]);?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'Необходим только для Reviews']) ?>

        <?= $form->field($model, 'date')->textInput(['placeholder' => 'Необходим только для News & Reviews']) ?>

        <?= $form->field($model, 'meta_desc')->textInput() ?>

        <?= $form->field($model, 'meta_key')->textInput() ?>

        <?= $form->field($model, 'meta_title')->textInput() ?>
    <? else : ?>

        <?= $form->field($model, 'type')->dropDownList(
            ArrayHelper::map($types, 'id', 'name'),
            [
                'prompt' => 'Выбор типа страницы',
            ]
        ) ?>

        <?= $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map($cats, 'id', 'title'),
            [
                'prompt' => 'Выбор категории',
            ]
        ) ?>

        <?= $form->field($model, 'status')->dropDownList(
            [
                '0' => 'Снято с публикации',
                '1' => 'Опубликованно',
            ],
            [
                'prompt' => 'Укажите статус страницы',
                'options' => [
                    '1' => ['Selected' => true],
                ],
            ]
        ) ?>

        <?= $form->field($model, 'url')->textInput(['placeholder' => 'catalog/{url-category}/{url-page}']) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => 'Необходим только для News']) ?>

        <?= $form->field($model, 'content')->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    'advlist autolink lists link charmap  print hr preview pagebreak',
                    'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                    'save insertdatetime media table contextmenu template paste image'
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                'external_filemanager_path' => '/plugins/responsive_filemanager/filemanager/',
                'filemanager_title' => 'Responsive Filemanager',
                'external_plugins' => [
                    'filemanager' => '/plugins/responsive_filemanager/filemanager/plugin.min.js',
                    'responsivefilemanager' => '/plugins/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                ],
            ]
        ]);?>

        <?= $form->field($model, 'ttx')->textarea(['rows' => 6, 'placeholder' => 'Необходим только для Products']) ?>

        <?= $form->field($model, 'path_to_video')->textInput(['maxlength' => true, 'placeholder' => 'YouTube Видео']) ?>

        <?= $form->field($model, 'price_dollar')->textInput(['placeholder' => 'Необходим только для Products']) ?>

        <?= $form->field($model, 'is_spec_offer')->checkbox() ?>

        <?= $form->field($model, 'spec_offer_price')->textInput(['placeholder' => 'Необходим только для Products']) ?>

        <?= $form->field($model, 'spec_offer_content')->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    'advlist autolink lists link charmap  print hr preview pagebreak',
                    'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                    'save insertdatetime media table contextmenu template paste image'
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                'external_filemanager_path' => '/plugins/responsive_filemanager/filemanager/',
                'filemanager_title' => 'Responsive Filemanager',
                'external_plugins' => [
                    'filemanager' => '/plugins/responsive_filemanager/filemanager/plugin.min.js',
                    'responsivefilemanager' => '/plugins/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                ],
            ]
        ]) ?>

        <?= $form->field($model, 'city')->textInput(['placeholder' => 'Необходим только для Reviews']) ?>

        <?= $form->field($model, 'date')->textInput(['placeholder' => 'Необходим толшько для News 9999-12-31']) ?>

        <?= $form->field($model, 'is_block')->checkbox() ?>

        <?= $form->field($model, 'weight')->textInput() ?>

        <?= $form->field($model, 'meta_desc')->textInput() ?>

        <?= $form->field($model, 'meta_key')->textInput() ?>

        <?= $form->field($model, 'meta_title')->textInput() ?>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
