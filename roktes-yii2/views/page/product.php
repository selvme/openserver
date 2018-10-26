<?php
use lesha724\youtubewidget\Youtube;
use yii\helpers\Html;
use yii\helpers\Url;
use himiklab\colorbox\Colorbox;
use app\widgets\PrForm;

$this->title = $product->meta_title ? $product->meta_title : $product->title;;
$this->registerMetaTag(['name' => 'keywords', 'content' => $product->meta_key]);
$this->registerMetaTag(['name' => 'description', 'content' => $product->meta_desc]);
?>

<div class="page-product container">
	<h1><?= $product->title ?></h1>
	<div class="pr-main">
		<div class="left">
			<div class="single-pr-thumbs">
				<div class="nav-prev"></div>
				<div class="item-list">
					<ul>
						<? $i=0; foreach($thumbs as $th) : ?>
							<? if($i === 0) : ?>
								<li class="active">
							<? else : ?>
								<li>
							<? endif; ?>
								<?=  Html::img(Url::home() . $th->path_to_img) ?>
							</li>
						<? $i++; endforeach; ?>
					</ul>
				</div>
				
				<div class="nav-next"></div>
			</div>
			<div class="single-pr-slides">
				<div id="pr-g" class="item-list">
					<ul>
						<? foreach($images as $img) : ?>
							<li>
								<a class="colorbox cboxElement" target="_blank" title="<?= $img->img_title ?>" href="<?= Url::home()?><?= $img->path_to_img ?>">
									<img src="<?= Url::home() . $img->path_to_img ?>" alt="<?= $img->img_alt ?>" title="<?= $img->img_alt ?> купить"class="pr-main-img">
								</a>
							</li>
						<? endforeach; ?>
					</ul>
				</div>
				
			</div>
		</div>
        <div class="right">
            <? if ($product->is_spec_offer) : ?>
                <div class="spec-mark text-color-dark-red">цена по акции</div>
            <? endif; ?>
            <? if (count($main_ch) >= 1 || count($add_ch) >= 1) : ?>
                <h2>Основные характеристики:</h2>
                <ul>
                    <? foreach ($main_ch as $ch) : ?>
                        <li>
						<span class="pr-name-ch">
							<?= $ch->name ?>
						</span>
                            <span class="pr-value-ch">
							<?= $ch->value ?>
						</span>
                        </li>
                    <? endforeach; ?>
                </ul>
                <ul>
                    <? foreach ($add_ch as $ch) : ?>
                        <li>
						<span class="pr-name-ch">
							<?= $ch->name ?>
						</span>
                            <span class="pr-value-ch">
							<?= $ch->value ?>
						</span>
                        </li>
                    <? endforeach; ?>
                </ul>
            <? endif; ?>
        </div>
	</div>
	<div class="pr-price-block">
		<? if(isset($product->price_dollar) || isset($product->spec_offer_price)) : ?>
			<? if(isset($product->spec_offer_price) && $product->is_spec_offer == 1) : ?>
			<div class="pr-price text-bold text-color-dark-red">
				<?= number_format($product->spec_offer_price, 0, ".", " ")?>*
				<b class="rub">&#8381;</b>
				<p class="pr-price-alt">* Указанная цена не является публичной офертой и требует уточнения!</p>
			</div>
			<? elseif($product->price_dollar != 0) : ?>
				<div class="pr-price text-bold text-color-light-blue">
					<?= $product->price_dollar ?>
					<b class="rub">&#8381;</b>
					<p class="pr-price-alt">* Указанная цена не является публичной офертой и требует уточнения!</p>
				</div>
			<? endif;?>
		<? endif;?>
		<div class="pr-section-kp">
			<?= PrForm::widget(); ?>
			<p>
				<i>Предложим оптимальную комплектацию, приятные цены и сроки поставки</i>
			</p>
		</div>
	</div>
	<div class="pr-additional">
		<div id="pr-accordion" class="accordion">
			<div class="tabs__caption">
				<div class="acc-active">Общие данные</div>
                <? if($product->ttx) :?>
                    <div>Тех. характеристики</div>
                <? endif; ?>
				<? if($product->path_to_video) :?>
					<div>Видео</div>
				<? endif; ?>
			</div>	
			<div class="tabs__content acc-active-content text">
				<?= $product->content ?>
			</div>
			<div class="tabs__content">
				<div class="table-wrap">
					<?= $product->ttx ?>
				</div>
			</div>
			<? if($product->path_to_video) :?>
				<div class="tabs__content video">
                    <?= Youtube::widget([
                        'video'=> $product->path_to_video,
                        /*
                            or you can use
                            'video'=>'CP2vruvuEQY',
                        */
                        'iframeOptions'=>[ /*for container iframe*/
                            'class'=>'youtube-video'
                        ],
                        'divOptions'=>[ /*for container div*/
                            'class'=>'youtube-video-div'
                        ],
                        'height'=>390,
                        'width'=>640,
                        'playerVars'=>[
                            /*https://developers.google.com/youtube/player_parameters?playerVersion=HTML5&hl=ru#playerapiid*/
                            /*	Значения: 0, 1 или 2. Значение по умолчанию: 1. Этот параметр определяет, будут ли отображаться элементы управления проигрывателем. При встраивании IFrame с загрузкой проигрывателя Flash он также определяет, когда элементы управления отображаются в проигрывателе и когда загружается проигрыватель:*/
                            'controls' => 1,
                            /*Значения: 0 или 1. Значение по умолчанию: 0. Определяет, начинается ли воспроизведение исходного видео сразу после загрузки проигрывателя.*/
                            'autoplay' => 0,
                            /*Значения: 0 или 1. Значение по умолчанию: 1. При значении 0 проигрыватель перед началом воспроизведения не выводит информацию о видео, такую как название и автор видео.*/
                            'showinfo' => 0,
                            /*Значение: положительное целое число. Если этот параметр определен, то проигрыватель начинает воспроизведение видео с указанной секунды. Обратите внимание, что, как и для функции seekTo, проигрыватель начинает воспроизведение с ключевого кадра, ближайшего к указанному значению. Это означает, что в некоторых случаях воспроизведение начнется в момент, предшествующий заданному времени (обычно не более чем на 2 секунды).*/
                            'start'   => 0,
                            /*Значение: положительное целое число. Этот параметр определяет время, измеряемое в секундах от начала видео, когда проигрыватель должен остановить воспроизведение видео. Обратите внимание на то, что время измеряется с начала видео, а не со значения параметра start или startSeconds, который используется в YouTube Player API для загрузки видео или его добавления в очередь воспроизведения.*/
                            'end' => 0,
                            /*Значения: 0 или 1. Значение по умолчанию: 0. Если значение равно 1, то одиночный проигрыватель будет воспроизводить видео по кругу, в бесконечном цикле. Проигрыватель плейлистов (или пользовательский проигрыватель) воспроизводит по кругу содержимое плейлиста.*/
                            'loop ' => 0,
                            /*тот параметр позволяет использовать проигрыватель YouTube, в котором не отображается логотип YouTube. Установите значение 1, чтобы логотип YouTube не отображался на панели управления. Небольшая текстовая метка YouTube будет отображаться в правом верхнем углу при наведении курсора на проигрыватель во время паузы*/
                            'modestbranding'=>  1,
                            /*Значения: 0 или 1. Значение по умолчанию 1 отображает кнопку полноэкранного режима. Значение 0 скрывает кнопку полноэкранного режима.*/
                            'fs'=>0,
                            /*Значения: 0 или 1. Значение по умолчанию: 1. Этот параметр определяет, будут ли воспроизводиться похожие видео после завершения показа исходного видео.*/
                            'rel'=>1,
                            /*Значения: 0 или 1. Значение по умолчанию: 0. Значение 1 отключает клавиши управления проигрывателем. Предусмотрены следующие клавиши управления.
                                Пробел: воспроизведение/пауза
                                Стрелка влево: вернуться на 10% в текущем видео
                                Стрелка вправо: перейти на 10% вперед в текущем видео
                                Стрелка вверх: увеличить громкость
                                Стрелка вниз: уменьшить громкость
                            */
                            'disablekb'=>0
                        ],
                    ]); ?>
				</div>
			<? endif; ?>
		</div>
	</div>
</div>
<?= Colorbox::widget([
    'targets' => [
        '.colorbox' => [
            'maxWidth' => 800,
            'maxHeight' => 600,
            'scrolling' => false,
            'rel' => 'pr-g',
        ],
    ],
    'coreStyle' => 3
]) ?>