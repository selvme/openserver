<?
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $category->meta_title ? $category->meta_title : $category->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->meta_key]);
$this->registerMetaTag(['name' => 'description', 'content' => $category->meta_desc]);
?>
<div class="container">
    <h1><?= $category->title?></h1>
    <div class="cat-wrap-items">
        <? for($i=0; $i<count($items); $i++) : ?>
            <div class="cat-item-wrap">
                <div class="cat-item">
                    <div class="left">
                        <a href="<?= Url::home()?><?= $items[$i]['url']?>">
                            <?= Html::img(Url::home() . $items[$i]['image']['path_to_img']) ?>
                        </a>
                    </div>
                    <div class="right">
                        <div class="cat-item-title">
                            <a href="<?= Url::home()?><?= $items[$i]['url']?>"><?= $items[$i]['title']?></a>
                        </div>
                        <div class="cat-item-ch">
                            <? foreach ($items[$i]['main_ch'] as $ch) : ?>
                                <div class="ch">
                                    <span class="ch-name"><?= $ch['name']?></span>
                                    <span class="ch-value"><?= $ch['value']?></span>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <a href="<?= Url::home()?><?= $items[$i]['url']?>" class="cat-item-more">Подробнее</a>
                    </div>
                </div>
            </div>
        <? endfor; ?>
    </div>
</div>
<? if($category['description'] != NULL) : ?>
<div class="container">
	<h2 class="cat-desc-h background-color-light-gray">Описание оборудования:</h2>
	<div class="cat-desc text">
		<?= $category['description'] ?>
	</div>
</div>
<? endif; ?>
