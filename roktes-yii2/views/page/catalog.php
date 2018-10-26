<?php
$this->title = 'Промышленное оборудование купить у компании "РОКТЭС"';
$this->registerMetaTag(['name' => 'keywords', 'content' => 'промышленное, оборудование, купить, компания, цена, заказать изготовление, доставка, россия']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Покупайте промышленное оборудование у нашей компании по выгодным ценам. Заказывайте только у нас изготовление оборудования с доставкой по всей России!']);

?>

<div class="catalog-items page-catalog">
	<div class="container">
		<h1>Каталог оборудования</h1>
		<? $it=1; foreach ($unit_catalog as $item) : ?>
			<div class="category-item">
				<h3 class="title-cat">
					<a href="<?= $item['url']?>" class="collapse-b item-<?= $it?>"> 
						<?= $item['title']?>	
					</a>
				</h3>
				<ul class="list collapse-toggle">
					<? for($i=0; $i<count($item['child']); $i++) : ?>
						<li>
							<a href="<?= $item['child'][$i]['url']?>"><?= $item['child'][$i]['title']?></a>
						</li>
					<? endfor; ?>
				</ul>
			</div>
		<? $it++; endforeach; ?>
	</div>
</div>