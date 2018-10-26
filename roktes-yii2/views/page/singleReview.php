<?php
use himiklab\colorbox\Colorbox;
use yii\helpers\Url;

$this->title = $project->meta_title ? $project->meta_title : 'Отзыв | ' . $project->title . ' | Роктэс';
$this->registerMetaTag(['name' => 'keywords', 'content' => $project->meta_key ? $project->meta_key : 'роктэс, официальное представительство, отзыв']);
$this->registerMetaTag(['name' => 'description', 'content' => $project->meta_desc]);

?>
<div class="container page-single-rev">
	<h1><?= $project->title ?></h1>
	<div class="left">
		<? foreach($images as $img) : ?>
		<div class="img-wrap">
			<a class="colorbox-scan cboxElement" target="_blank" href="<?= Url::home()?><?= $img->path_to_img ?>">
				<img src="<?= Url::home()?><?= $img->path_to_img ?>" alt="<?= $img->img_alt ?>">
			</a>
		</div>
		<? endforeach; ?>
		<div class="common-data">
			Адрес поставки: <span class="city-service"><?= $project->city ?></span>
			<br />
			Дата: <span class="date-service"><?= $project->date ?></span>
		</div>
		<div class="exact-data">
			<?= \yii\helpers\HtmlPurifier::process($project->content)?>
		</div>
	</div>
	<div class="right">
		<div class="single-proj-image">
			<a class="colorbox-scan cboxElement" target="_blank" href="<?= Url::home()?><?= $scan->scan_path ?>">
				<img src="<?= Url::home()?><?= $scan->scan_path ?>" alt="<?= $scan->scan_alt ?>">
			</a>
		</div>
	</div>
</div>
<?= Colorbox::widget([
    'targets' => [
        '.colorbox-scan' => [
            'maxWidth' => 800,
            'maxHeight' => 600,
            'scrolling' => false,
        ],
    ],
    'coreStyle' => 3
]) ?>
