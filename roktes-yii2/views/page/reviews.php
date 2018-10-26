<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$links = $pages->getLinks();

foreach ($links as $key => $value) {
    if ($key === 'next' || $key === 'prev')
    {
        $this->registerLinkTag([
            'rel' => $key,
            'href' => $value,
        ]);
    }
}

$page = $pages->page != 0 ? sprintf(' | Страница %d', $pages->page + 1) : '';
$this->title = sprintf('Отзывы клиентов компании "РОКТЭС"%s', $page);
if ($pages->page === 0)
{
    $this->registerMetaTag(['name' => 'keywords', 'content' => 'роктэс, отзывы, отзыв']);
    $this->registerMetaTag(['name' => 'description', 'content' => 'На этой странице вы можете ознакомиться с полным списком отзывов наших клиентов. Узнать больше про отзывы клиентов вы можете на нашем официальном сайте']);
}
$this->registerLinkTag(['name' => 'canonical', 'content' => Url::home(true) . 'reviews']);

?>
<div class="container">
	<h1>Отзывы наших клиентов</h1>
	<ul class="front-page-projects">
		<? foreach($projects as $item) : ?>
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
	<div class="page-pag">
		<? echo LinkPager::widget([
    		'pagination' => $pages,
		]) ?>
	</div>
</div>

