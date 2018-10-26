<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Запрашиваемая страница не найдена | РОКТЭС';
?>
<div class="container page-error">
    <a href="<?= Url::home(true)?>"><?= Html::img('/image/logo.png', ['title' => Yii::$app->name, 'alt' => Yii::$app->name])?></a>
	<h1>Страница не найдена!</h1>
	<h3>Вы ищите страницу, которая была удалена или скрыта :(</h3>

	<p>Вы можете воспользоваться <a href="<?= Url::home() ?>catalog">каталогом</a> или перейти на <a href="<?= Url::home()?>">главную страницу</a>.</p>
</div>