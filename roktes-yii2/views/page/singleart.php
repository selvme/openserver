<?php

$this->title = $art->meta_title ? $art->meta_title : 'Статья | ' . $art->title . ' | Роктэс';
$this->registerMetaTag(['name' => 'keywords', 'content' => $art->meta_key]);
$this->registerMetaTag(['name' => 'description', 'content' => $art->meta_desc]);

?>
<div class="container page-single-art">
	<h1><?= $art->title ?></h1>
	<p><?= $art['content']?></p>
</div>
