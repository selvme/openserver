<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\widgets\FooterForm;
?>	
    <div class="top-footer">
        <div class="footer-contact-form">
            <div class="container">
                <div class="seo-headline">Остались вопросы?</div>
                <? Pjax::begin([
					'id' => 'footerform',
				]); ?>
                    <?= FooterForm::widget(); ?>
                <? Pjax::end(); ?>
            </div>
        </div>
    </div>
	<div class="bot-footer background-color-dark-blue">
		<div class="container">
			<div class="menu-block-wrapper">
				<ul class="footer-menu">
					<? $count = count($menuItems); 
					for ($i=0; $i < $count; $i++) : ?>
						<? if ($i != 0 && $i != $count - 1) : ?>
							<li>
						<? elseif($i == 0) : ?>
							<li class="first">
						<? else : ?>
							<li class="last">
						<? endif;?>
								<a href="<?= Url::to($menuItems[$i]['url']) ?>">
									<?= $menuItems[$i]['label']; ?>
								</a>
							</li>
					<? endfor; ?>
				</ul>
			</div>
		</div>
		
		<hr />
		<div class="container">
			<div class="footer-info">
				<div class="copyright col-xs-7 col-sm-6 col-md-4">
						РОКТЭС -  комплексная поставка<br /> промышленного оборудования
				</div>
				<div class="sitemap col-xs-0 col-sm-0 col-md-5">						
					<a href="<?= Url::toRoute('sitemap')?>">Карта сайта</a>
				</div>							
				<div class="footer-contacts col-xs-5 col-sm-6 col-md-3">
					<a href="tel:+73517906543" rel="nofollow" onclick="yaCounter7831060.reachGoal('contacts');">Телефон: +7 (351) 790-65-43</a><br />
					<a href="mailto:offer@roktes.ru" rel="nofollow" onclick="yaCounter7831060.reachGoal('contacts');">E-mail: offer@roktes.ru</a>
				</div>
			</div>
		</div>
		
	</div>
	<div class="mob-footer background-color-dark-blue">
		<div class="call">
			<a href="tel:+78003333589" rel="nofollow" onclick="yaCounter7831060.reachGoal('contacts');">
				<i class="fa fa-phone" aria-hidden="true"></i>
			</a>
		</div>
		<div class="write">
			<a href="mailto:offer@roktes.ru" rel="nofollow" onclick="yaCounter7831060.reachGoal('contacts');">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
			</a>
		</div>
		<div class="upper">
			<a href="#" class="page-up">
				<i class="fa fa-arrow-up" aria-hidden="true"></i>
			</a>
		</div>
	</div>
