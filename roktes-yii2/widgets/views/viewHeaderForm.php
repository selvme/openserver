<?php
use himiklab\yii2\recaptcha\ReCaptcha;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

?>
<? Modal::begin([
	'header' => '<h2>Получить КП</h2>',
	'toggleButton' => [
		'label' => 'Получите коммерческое предложение',
		'tag' => 'a',
		'class' => 'btn-kp text-color-dark-red',
	],
]); ?>

	<? Pjax::begin([
		'id' => 'headform',
	]); ?>
		<?php $f = ActiveForm::begin([
			'options' => ['data-pjax' => true],
			'fieldConfig' => ['template' => "{label}\n{input}",],
		]); ?>
			<?= $f->field($model, 'city')->label('Город')->textInput(array(
					'placeholder' => 'Для расчета стоимости доставки...',
					)); ?>
			<?= $f->field($model, 'name')->label('Ваше ФИО')->textInput(array(
					'placeholder' => '',
					)); ?>
			<?= $f->field($model, 'phone')->label('Контактный номер телефона')->widget(PhoneInput::className(), [
    					'jsOptions' => [
    				    'preferredCountries' => ['ru', 'ua'],
    				    'allowExtensions' => false,
        				'onlyCountries' => ['ru', 'ua', 'kz', 'in', 'by', 'cn', 'hk', 'tw'],
        				'nationalMode' => false,
    					],
    					'options' => [
    						'placeholder' => '',
    					]
					]); ?>
			<?= $f->field($model, 'email')->label('Ваш E-mail')->input('email', [
    				'placeholder' => '',
    				]); ?>
    		<?= $f->field($model, 'text')->label('Что Вас интересует?')->textarea(array(
    			'rows'=>2, 
    			'placeholder' => 'Укажите желаемый станок и важные для Вас характеристики...',
    			'class' => 'form-control kp-text-area',
    		)) ?>
            <?= $f->field($model, 'check', ['template' => "{input}{label}\n{error}"])->checkbox([
                'label' => 'Я согласен на обработку персональных данных.',
            ]); ?>
<!--			--><?//= $f->field($model, 'reCaptcha', ['template' => "{input}\n{error}"])->widget(ReCaptcha::className()) ?>

    		<?= Html::submitButton('Получить КП', ['class' => 'btn btn-primary']) ?>
		<?php ActiveForm::end(); ?>
	<? Pjax::end(); ?>

<? Modal::end(); ?>