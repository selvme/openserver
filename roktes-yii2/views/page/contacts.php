<?php
use app\widgets\Contacts;

$this->title = 'Контактная информация компании "РОКТЭС"';
$this->registerMetaTag(['name' => 'keywords', 'content' => 'роктэс, контакты, связь, связаться, контакт, адрес, телефон, емайл, майл, мейл, емейл, e-mail, email, mail']);
$this->registerMetaTag(['name' => 'description', 'content' => 'На данной странице Вы можете ознакомиться с номерами телефонов и остальной контактной информацией нашей компании. Узнать адрес компании Вы можете на нашем официальном сайте!']);

?>
<div class="container page-contacts">
	<h1><?= $this->title ?></h1>
	<div>
		<p>
			<strong>
				Центральный офис ООО &quot;Компания &quot;РОКТЭС&quot; в г. Челябинске
			</strong>
		</p>

		<p>
			<strong>ИНН 7447280142, КПП 744701001 , ОГРН 1177456106189
			</strong>
		</p>

		<p>
			<strong>Юридический адрес:</strong> 
			454084 г. Челябинск, Калинина, д. 5 &laquo;Б&raquo; - 2
		</p>

		<p>
			<strong>Почтовый адрес:</strong> 
			454084, г. Челябинск,&nbsp;ул. Калинина, д. 5 &laquo;Б&raquo; - 3
		</p>

		<p>
			<strong>Р/с 40702810807180009378</strong>
			в Калининском филиале ПАО &laquo;Челиндбанк&raquo; г. Челябинск
		</p>

		<p>
			<strong>Кор.счет</strong>
			30101810400000000711, <strong>БИК</strong> 047501711
		</p>

		<p>
			<strong>Телефоны</strong>: 
			<a href="tel:88003333589" onclick="yaCounter7831060.reachGoal('contacts');" rel="nofollow">8 (800) 333-35-89</a>
			,&nbsp;
			<a href="tel:+73517906543" onclick="yaCounter7831060.reachGoal('contacts');" rel="nofollow">+7 (351) 790-65-43</a>
		</p>

		<p>
			<strong>Электронная почта</strong>: 
			<a href="mailto:offer@roktes.ru" onclick="yaCounter7831060.reachGoal('contacts');" rel="nofollow">offer@roktes.ru</a>
		</p>

		<p><strong>Время работы</strong>: 8:30 - 17:30 (МСК +2)</p>
	</div>
	<br />
	<?= Contacts::widget(); ?>
</div>
<div class="contact-map">
      <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ada5fd0d4e2a1acedac2899dccab8edd1f99837df724de96de6a586d86f331a21&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=false"></script>
</div>
