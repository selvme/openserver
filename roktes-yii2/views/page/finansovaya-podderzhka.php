<?php
use app\widgets\Partners;

$this->title = 'Финансовая поддержка компании "РОКТЭС"';
$this->registerMetaTag(['name' => 'keywords', 'content' => 'роктэс, лизинг, оборудования, оборудование']);
$this->registerMetaTag(['name' => 'description', 'content' => 'На данной странице Вы можете увидеть финансовых партнеров нашей компании. С лизингом компании "РОКТЭС" Вы можете ознакомиться на нашем официальном сайте.']);

?>
<div class="page-leasing">
	<div class="container">
		<h1>Финансовая поддержка</h1>
		<?= Partners::widget() ?>
	</div>
</div>
