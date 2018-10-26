<?php
use yii\helpers\Url;

$this->title = 'Карта сайта Компании "РОКТСЭС"';

?>
<div class="container page-sitemap text">
	<h1>Карта сайта</h1>
	<? if($map) :?>
		<ul>
		<? foreach($map as $item) : ?>
			<li>
				<a href="<?= Url::toRoute($item['url'])?>"><?= $item['label'] ?></a>
				<? if(count($item['items']) >= 1) : ?>
					<ul>
						<? foreach($item['items'] as $subitem) : ?>
							<li>
								<a href="<?= Url::toRoute($subitem['url'])?>">
									<?= $subitem['label'] ?>
								</a>
                                <? if ($subitem['items']) : ?>
                                    <ul>
                                        <? foreach($subitem['items'] as $last) : ?>
                                            <li>
                                                <a href="<?= Url::toRoute($last['url'])?>">
                                                    <?= $last['label'] ?>
                                                </a>
                                            </li>
                                        <? endforeach; ?>
                                    </ul>
                                <? endif; ?>
							</li>
						<? endforeach; ?>
					</ul>
				<? endif;?>
			</li>
		<? endforeach; ?>
		</ul>
	<? endif; ?>
</div>