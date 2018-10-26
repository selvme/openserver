<?php
use yii\helpers\Url;

$this->title = 'Персонал работающий в компании "РОКТЭС"';
$this->registerMetaTag(['name' => 'keywords', 'content' => 'роктэс, официальное представительство,']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Ознакомиться с полезной информацией о персонале компании можно в нашей статье. Более подробная информация о персонале компании на сайте "РОКТЭС".']);

?>

<div class="container page-personal text">
	<h1>Наш персонал</h1>
	<p class="text-bold">Главный актив компании &ndash; высококвалифицированный персонал.</p>
	<h4>Наши специалисты:</h4>
	<ul>
		<li>Имеют высшее техническое образование;</li>
		<li>Обладают реальным опытом работы на российских предприятиях, осуществляющих производство металлоконструкций;</li>
		<li>Регулярно проходят стажировку у зарубежных партнеров;</li>
		<li>Владеют иностранными языками;</li>
		<li>Следят за изменениями правил международной торговли;</li>
		<li>Посещают выставки, производственные площадки заводов-производителей оборудования;</li>
		<li>Получают и анализируют информацию о новых технологиях и новшествах применяемых в производстве различных типов продукции, как в России, так и за рубежом;</li>
		<li>Ищут возможные пути оптимальной организации производственных процессов.</li>
	</ul>
	<h2>Ведущие специалисты:</h2>
	<div class="exact-personal">
		<div class="personal-photo">
			<img alt="" src="<?= Url::home()?>img/personal/personal_photo_1.png" />
		</div>
		<h3 class="text-color-light-blue">Красюк Анатолий<br />Дмитриевич</h3>
		<p class="text-bold">Генеральный директор</p>
	</div>
	<div class="exact-personal">
		<div class="personal-photo">
			<img alt="" src="<?= Url::home()?>img/personal/personal_photo_2.png" />
		</div>
		<h3 class="text-color-light-blue">Белозерцев Виктор<br />Иванович</h3>
		<p class="text-bold">Коммерческий директор</p>
	</div>
	<div class="exact-personal">
		<div class="personal-photo">
			<img alt="" src="<?= Url::home()?>img/personal/personal_photo_3.png" />
		</div>
		<h3 class="text-color-light-blue">Кашицин Александр<br />Владимирович</h3>
		<p class="text-bold">Начальник коммерческого отдела</p>
	</div>
</div>
