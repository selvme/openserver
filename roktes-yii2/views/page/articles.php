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
$this->title = sprintf('Статьи на сайте компании "РОКТЭС"%s', $page);
if ($pages->page === 0)
{
    $this->registerMetaTag(['name' => 'keywords', 'content' => 'статьи, роктэс, сайт']);
    $this->registerMetaTag(['name' => 'description', 'content' => 'Ознакомиться с полезной информацией и статьями компании можно в нашей статье. Более подробные статьи о компании на сайте "РОКТЭC".']);
}
$this->registerLinkTag(['name' => 'canonical', 'content' => Url::home(true) . 'articles']);

?>
<div class="container page-articles text">
	<h1>Статьи</h1>
		<? foreach($articles as $item) : ?>
			<div class="item">
				<h2>
					<a href="<?= Url::toRoute([$item['url']]) ?>"><?= $item['title']?></a>
				</h2>
				<p><?= substr($item['content'], 0, strpos($item['content'], '.', 100)+1); ?><a href="<?= Url::toRoute([$item['url']]) ?>" class="text-color-light-blue"> / читать дальше...</a></p>
			</div>
		<? endforeach; ?>
</div>
<div class="container page-pag">
    <? echo LinkPager::widget([
        'pagination' => $pages,
    ]) ?>
</div>