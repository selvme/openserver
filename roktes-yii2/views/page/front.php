<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use himiklab\thumbnail\EasyThumbnailImage;
use app\widgets\Partners;
use app\widgets\Contacts;
use himiklab\colorbox\Colorbox;
use app\modules\for_img\models\DbImg;

$this->title = "Металообрабатывающее оборудование - купить от поставщика РОКТЭС";
$this->registerMetaTag(['name' => 'keywords', 'content' => 'металлообрабатывающее оборудование станки купить продажа обработка металла']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Продажа металлообрабатывающего оборудования от проверенных производителей. Заказывайте станки и другое оборудование для обработки металла от компании-поставщика Роктэс.']);
$this->registerLinkTag(['rel' => 'cononical', 'href' =>"https://roktes.ru"]);

?>

<div id="front-carousel" class="carousel slide">
	<div class="carousel-inner">
		<? foreach ($slider_data as $product) :?>
			<? if($slider_data[0]['id'] == $product['id']) :?>
				<div class="item active">
			<? else :?>
				<div class="item">
			<? endif;?>
			<? echo Html::img(Yii::$app->urlManager->baseUrl . '/img/front/front-slider-background.jpg', ['class' => 'front-slider-background']); ?>
			<div class="container">
				<? echo Html::img(Yii::$app->urlManager->baseUrl . '/img/front/front-slide-pinned-background.png', ['class' => 'front-slider-pinned']); ?>
				<div class="front-slider-product-img"><? echo Html::img($product['path_to_img'])?>
				</div>
				<div class="front-slider-content">
					<div class="front-slider-product-name">
						<b><?= $product['title'] ?>!</b>
					</div>
					<hr>
					<p class="front-slider-product-price">
						<b><? echo number_format($product['spec_offer_price'], 0, ".", " ")?></b><b class="rub">&#8381;</b>
					</p>
					<div class="front-slider-additional">
						<ul>
							<li>Шеф монтажные работы</li>
							<li>Пусконаладочные работы</li>
							<li>Инструктаж персонала</li>
							<li>Гарантия 12 мес</li>
						</ul>
					</div>
				</div>
			</div>
			</div>
		<? endforeach; ?>
	</div>

	<? if (count($slider_data) > 1) : ?>
		<a class="left carousel-control" href="#front-carousel" data-slide="prev">
			<span class="left"><</span>
		</a>
		<a class="right carousel-control" href="#front-carousel" data-slide="next">
			<span class="right">></span>
		</a>
	<? endif; ?>
</div>
<div class="single-row catalog-items background-color-light-gray">
	<div class="container">
		<div class="front-h1">Оборудование</div>
		<? $it=1; foreach ($unit_catalog as $item) : ?>
			<div class="category-item">
				<div class="front-h3 title-cat">
					<a href="<?= $item['url']?>" class="collapse-b item-<?= $it?>"> 
						<?= $item['title']?>	
					</a>
				</div>
				<ul class="list collapse-toggle">
					<? for($i=0; $i<count($item['child']); $i++) : ?>
						<li>
							<a href="<?= $item['child'][$i]['url']?>"><?= $item['child'][$i]['title']?></a>
						</li>
					<? endfor; ?>
				</ul>
			</div>
		<? $it++; endforeach; ?>
	</div>
</div>
<div class="single-row background-color-white">
	<div class="container">
		<div class="front-h2">Поставляем оборудование "Под Ключ"</div>
		<ul class="front-page-bykey">
		<li class="f-list">
			<div><img src=" <? echo Yii::$app->urlManager->baseUrl . '/img/front/ic_coge' . '.png' ?> " alt="" /></div>
			<div class="front-h3">Осуществляем все инжиниринговые работы</div>
			<div class="s-list">
				<i class="fa fa-check-square" aria-hidden="true"></i>Разрабатываем техническое задание;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Подбираем необходимое оборудование согласно ТЗ;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Разрабатываем технические схемы и внутризаводскую планировку.
			</div>
		</li>
		<li class="f-list">
			<div><img src="<? echo Yii::$app->urlManager->baseUrl . '/img/front/ic_fastdelivery' . '.png'?>" alt="" /></div>
			<div class="front-h3">Обеспечиваем поставку оборудования</div>
			<div class="s-list">
				<i class="fa fa-check-square" aria-hidden="true"></i>Ведем переговоры с поставщиками;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Делаем таможенное оформление;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Доставляем оборудование до объекта.
			</div>
		</li>
		<li class="f-list">
			<div><img src="<? echo Yii::$app->urlManager->baseUrl . '/img/front/ic_man' . '.png'?>" alt="" /></div>
			<div class="front-h3">Выполняем запуск оборудования на вашем производстве</div>
			<div class="s-list">
				<i class="fa fa-check-square" aria-hidden="true"></i>Проводим шеф-монтажные, монтажные и пусконаладочные работы;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Обучаем персонал;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Переводим инструкции на русский язык.
			</div>
		</li>
		<li class="f-list">
			<div><img src="<? echo Yii::$app->urlManager->baseUrl . '/img/front/ic_settings' . '.png'?>" alt="" /></div>
			<div class="front-h3">Осуществляем сервисное обслуживание</div>
			<div class="s-list">
				<i class="fa fa-check-square" aria-hidden="true"></i>Гарантийный ремонт оборудования;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Поставляем запасные части и расходные материалы;<br />
				<i class="fa fa-check-square" aria-hidden="true"></i>Ремонтируем оборудование с истекшей гарантией.
			</div>
		</li>
		</ul>
	</div>
</div>
<div class="single-row background-color-light-gray">
	<div class="container">
		<div class="front-h2">Наши недавние проекты</div>
		<ul class="front-page-projects">
			<? foreach($unit_project as $item) : ?>
				<li>
					<a href="<?= $item['url']?>">
						<img src="<?= $item['path_to_img']?>" alt="<?= $item['img_alt']?>">
						<div>
							<span class="title-service"><?= $item['description']?></span>
							<hr />
							<p>
								Адрес поставки: <span class="city-service"><?= $item['city']?></span>
								<br />
								Когда: <span class="date-service"><?= $item['date']?></span>
							</p>
						</div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<div class="more-button">
			<a href="reviews" class="simple-blue-button">Все проекты</a>
		</div>
	</div>
</div>
<div class="single-row reviews-front background-color-white">
	<div class="container">
		<div class="front-h2">Отзывы наших клиентов</div>
		<ul class="front-page-reviews">
			<? foreach($unit_project as $item) : ?>
				<li>
					<a class="colorbox" target="_blank" href="<?= Yii::$app->urlManager->baseUrl . $item['scan_path']?>">
						<? 	echo EasyThumbnailImage::thumbnailImg(
    							Yii::$app->urlManager->baseUrl . $item['scan_path'],
    							300,
    							430,
    							EasyThumbnailImage::THUMBNAIL_OUTBOUND,
    							['alt' => $item['scan_alt']]
							);?>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<div class="more-button">
				<a href="reviews" class="simple-blue-button">Все отзывы</a>
		</div>
	</div>
</div>
<div class="single-row partners-front background-color-light-gray">
	<div class="container">
		<div class="front-h2">Финансовая поддержка</div>
		<?= Partners::widget() ?>
	</div>
</div>
<div class="single-row background-color-white">
	<div class="container">
		<h2>Кто мы такие?</h2>
		<div class="who-we-are">
			<p>
				Несмотря на стремительное развитие и расширение сферы влияния информационных технологий, альтернативных источников электроэнергии и робототехники, тяжелая промышленность до сих пор уверенно лидирует, как по объемам производства, так и по востребованности на рынке. Металлургия является тем связующим компонентом, который не только объединяет все другие отрасли человеческой жизни, но и вообще делает возможным технологический и научный прогресс. Более того, без металлургии невозможна и социализация, ведь именно благодаря металлоконструкциям создаются комфортные условия проживания. Разве создали бы первый автомобиль, многоэтажный дом, летательный аппарат без металла? Ни одна современная ферма, школа, собор, электростанция, фабрика, жилой дом или мост не обходятся без стальных балок и анкеров.
			</p>
			<p class="text-img">
				<img src="<?= Url::home()?>img/front/block_7_1.png" alt="" />
				<img src="<?= Url::home()?>img/front/block_7_2.png" alt="" />
				<img src="<?= Url::home()?>img/front/block_7_3.png" alt="" />
				<img src="<?= Url::home()?>img/front/block_7_4.png" alt="" />
				<img src="<?= Url::home()?>img/front/block_7_5.png" alt="" />
			</p>
			<p>&nbsp;</p>
			<h3>Финишные этапы</h3>
			<p>
				Для изготовления любой детали недостаточно лишь сырья и литейного цеха. Не менее важно в производстве оборудование для обработки металла. Ведь с момента формовки заготовки до поступления в продажу проходит огромное количество различных производственных процессов: фрезерная обработка, гибка, раскрой, сварка, сверление, очистка, полировка и многое другое. Российская компания «РОКТЭС» занимается продажей импортной техники для осуществления всех этапов обработки изделий из металла. Наши поставщики металлообрабатывающего оборудования являются надежными и проверенными производителями из многих стран восточной части мира: Китая, Южной Кореи, Тайваня, Новой Зеландии.
			</p>
			<p class="text-img">
				<img src="/img/front/block_7_6.png" alt="" />
				<img src="/img/front/block_7_7.png" alt="" />
				<img src="/img/front/block_7_8.png" alt="" />
				<img src="/img/front/block_7_9.png" alt="" />
			</p>
			<p>
				Вопреки возможным стереотипам, их металлообрабатывающее оборудование и техника обладают высочайшим качеством, надежностью, безопасностью и большим сроком служения, о чем красноречиво свидетельствуют сертификаты, гарантийные документы и благодарные отзывы клиентов на сайте! Если вам необходимо обеспечить промышленное предприятие хорошей материально-технической базой, стоит немедленно купить металлообрабатывающее оборудование из каталога сайта компании «РОКТЭС». Мы гарантируем вам качественную обработку и высокую производительность!
			</p>
			<p>&nbsp;</p>
			<h3>Спектр услуг</h3>
			<p>
				Основной нашей специализацией, бесспорно, является продажа металлообрабатывающего оборудования. Но очень часто, для наладки производственного процесса, недостаточно лишь установить технику на промышленный объект. Иногда требуется настройка машин, планирование этапов, постановка процесса «на конвейер», обеспечение обратной связи с производителем, перевод технической литературы и т.д.
			</p>
			<p>
				<b>Все наши услуги можно разделить на пять больших групп:</b>
			</p>
			<ul class="front-page-whoweare">
				<li>
					<img src="/img/front/block_7_list_1.png" alt=""/>
					<i class="fa fa-check"></i> 
					<p><b>Непосредственно, продажа металлообрабатывающего оборудования.</b>Непосредственно, продажа металлообрабатывающего оборудования. В нашем каталоге вы найдете разнообразные станки для фрезерной обработки, гибки, раскроя и правки, технику для произведения сварочных работ, дробеметной очистки и нанесения покрытий, а также машины для производства двутавровых балок, сендвич-панелей, профилей;</p>
				</li>
				<li>
					<img src="/img/front/block_7_list_2.png" alt=""/>
					<i class="fa fa-check"></i> 
					<p><b>Инженерная работа.</b> Включает в себя все виды услуг, связанные с технической наладкой и рационализацией производственного процесса. Металлообрабатывающее оборудование может быть непроизводительным, несмотря на свое качество, технические характеристики и функциональные возможности. Для увеличения объемов производства, иногда требуется изменить его схему;</p>
				</li>
				<li>
					<img src="/img/front/block_7_list_3.png" alt=""/>
					<i class="fa fa-check"></i> 
					<p><b>Логистика.</b> Все работы, связанные с доставкой техники заказчику. Особенно актуально для клиентов из других областей России, а также жителей соседних стран. Ведь оборудование для обработки металла нужно не только перевезти, но и оформить на таможне;</p>
				</li>
				<li>
					<img src="/img/front/block_7_list_4.png" alt=""/>
					<i class="fa fa-check"></i> 
					<p><b>Обслуживание.</b> Включает ремонт и замену расходных материалов;</p>
				</li>
				<li>
					<img src="/img/front/block_7_list_5.png" alt=""/>
					<i class="fa fa-check"></i> 
					<p><b>Коммуникативные работы.</b> Так как все наши поставщики – не просто иностранные компании, а представители азиатских народностей, необходим качественный перевод инструкций, гарантийных документов и другой литературы. Кроме того, иногда нужно обеспечить связь между заказчиком и производителем.</p>
				</li>
			</ul>
			<p>&nbsp;</p>
			<p>
				<b>Мы осуществляем доставку оборудования в любой уголок России, а также за границу. Спешите купить металлообрабатывающее оборудование высочайшего качества только у нас!</b>
			</p>
		</div>
	</div>
</div>
<div class="single-row background-color-light-gray">
	<div class="container">
		<div class="front-h2">Как нас найти?</div>
		<?= Contacts::widget() ?>
	</div>
	<div class="contact-map">
      <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ada5fd0d4e2a1acedac2899dccab8edd1f99837df724de96de6a586d86f331a21&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=false"></script>
    </div>
</div>
<?= Colorbox::widget([
    'targets' => [
        '.colorbox' => [
            'maxWidth' => 800,
            'maxHeight' => 600,
            'scrolling' => false,
        ],
    ],
    'coreStyle' => 3
]) ?>