<?php
use yii\helpers\Url;

$this->title = 'Специальные предложения от компании "РОКТЭС"';
$this->registerMetaTag(['name' => 'description', 'content' => 'На этой странице Вы можете ознакомиться с полным списком специальных предложений для наших клиентов. Узнать больше про специальные предложения Вы можете на нашем официальном сайте']);

?>
<div class="container page-spec-offer text">
    <h1>Специальные предложения</h1>
	<div class="item">
		<? if(isset($spec) && count($spec) >= 1) : ?>
		<? foreach($spec as $sp) : ?>
			<h2 class="text-color-dark-red"><?= $sp['title']?></h2>
			<div class="left">
				<div class="img-wrap">
					<img src="<?= Url::home()?><?= $sp['path_to_img']?>" alt="">
				</div>
				<div class="sp-detail">
					<div class="pr-price text-bold text-color-dark-red">
						<?= number_format($sp['spec_offer_price'], 0, ".", " ")?>
						<b class="rub">&#8381;</b>
						<p class="pr-price-alt">* Указанная цена не является публичной офертой и требует уточнения!</p>
					</div>
					<a href="<?= Url::home()?><?= $sp['url']?>" class="btn-kp base-light-blue-button">Перейти на страницу оборудования</a>
				</div>
			</div>
			<div class="right">
				<div class="sp-add">
					<h3>Указанная цена включает в себя:</h3>
					<?= $sp['spec_offer_content']?>
				</div>
			</div>
		<? endforeach; ?>
		<? else : ?>
			<h1>Акций не найдено :(</h1>
			<p>Мы всегда стараемся предоставить для Вас лучшие условия и приятные цены.</p>
			<p>Скоро мы сможем предложить для Вас что-то интересное!</p>
		<? endif; ?>
	</div>
</div>