<?php
use yii\helpers\Html;
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
$this->title = sprintf('Интересные Новости компании "РОКТЭС"%s', $page);
if ($pages->page === 0)
{
    $this->registerMetaTag(['name' => 'keywords', 'content' => 'роктэс, новости, сайт']);
    $this->registerMetaTag(['name' => 'description', 'content' => 'Ознакомиться с полезной информацией и новостями компании можно в нашей статье. Более подробные новости о компании на сайте "РОКТЭС".']);
}
$this->registerLinkTag(['name' => 'canonical', 'content' => Url::home(true) . 'news']);

?>
<div class="container page-news text">
	<h1>Новости</h1>
		<? foreach($news as $item) : ?>
			<div class="item">
				<div class="left">
					<span class="date-service"><?= $item['date']?></span>
                    <? if ($item['image']) : ?>
					<div class="wrap-img">
						<a href="<?= Url::toRoute([$item['url']]) ?>">
							<?= Html::img(Url::home() . $item['image']['path_to_img'])?>
						</a>
					</div>
                    <? endif; ?>
				</div>
				<div class="right">
					<h2>
						<a href="<?= Url::toRoute([$item['url']]) ?>"><?= $item['title']?></a>
					</h2>
					<p><?= $item['description']?><a href="<?= Url::toRoute([$item['url']]) ?>" class="text-color-light-blue"> / читать дальше...</a></p>
				</div>
			</div>
		<? endforeach; ?>
</div>
<div class="container page-pag">
    <? echo LinkPager::widget([
        'pagination' => $pages,
    ]) ?>
</div>