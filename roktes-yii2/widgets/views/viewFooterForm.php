<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use \himiklab\yii2\recaptcha\ReCaptcha;
?>

<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

	<p class="form-info">
		Получите консультацию по подбору оборудования. Предложим<br> <b>оптимальную</b> комплектацию, <b>приятные</b> цены и <b>сроки</b> поставки.
	</p>
	<div class="row">
		<div class="form-foto col-md-3 col-sm-3">
			<?= Html::img('/img/contacts/kashicin.jpg'); ?>
		</div>
		<div class="col-md-9 col-sm-9">
			<div class="row">
				<div class="col-md-4">
					<?= $form->field($model, 'name')->label(false)->textInput(array(
					'placeholder' => 'Имя',
					)); ?>
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'phone')->label(false)->widget(PhoneInput::className(), [
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
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'email')->label(false)->input('email', [
    				'placeholder' => 'E-mail',
    				]);?>
				</div>
			</div>
    		<?= $form->field($model, 'text')->label(false)->textarea(array('rows'=>3, 'placeholder' => 'Задайте Ваш вопрос здесь...')); ?>
            <?= $form->field($model, 'check', ['template' => "{input}{label}\n{error}"])->checkbox([
                'label' => 'Я согласен на обработку персональных данных.',
            ]); ?>
		</div>
	</div>

    <div class="row">
    	<div class="col-md-5 perezvonim">
    		Ответим в течение 1-ого часа в рабочее время
    	</div>
    	<div class="col-sm-8 col-md-4">
<!--            --><?//= $form->field($model, 'reCaptcha', ['template' => "{input}\n{error}"])->widget(ReCaptcha::className()) ?>
    	</div>
    	<div class="col-sm-4 col-md-3">
    		<?= Html::submitButton('Спросить', ['class' => 'btn btn-primary']) ?>
    	</div>
    </div>

<?php ActiveForm::end(); ?>