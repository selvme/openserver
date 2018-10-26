<?php
use himiklab\colorbox\Colorbox;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $new->meta_title ? $new->meta_title : 'Новость | ' . $new->title . ' | Роктэс';
$this->registerMetaTag(['name' => 'keywords', 'content' => $new->meta_key]);
$this->registerMetaTag(['name' => 'description', 'content' => $new->meta_desc]);

?>
<div class="container page-single-news">
	<h1><?= $new->title ?></h1>
	<p><?= $new->content ?></p>
	<div class="img-group">
		<? foreach($images as $i) :?>
			<div id="new-g" class="wrap-img">
				<a class="colorbox" target="_blank" href="<?= Url::toRoute($i->path_to_img)?>">
					<?= Html::img(Url::home() . $i->path_to_img, ['alt' => $i->img_alt])?>
				</a>
			</div>
		<? endforeach; ?>
	</div>
</div>

<?= Colorbox::widget([
    'targets' => [
        '.colorbox' => [
            'maxWidth' => 800,
            'maxHeight' => 600,
            'scrolling' => false,
            'rel' => 'new-g',
        ],
    ],
    'coreStyle' => 3
]) ?>
