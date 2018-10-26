<?php
use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="<?= Yii::$app->language ?>">
<head>
    <link rel="icon" href="/image/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon-16x16.png">
    <link rel="manifest" href="/js/manifest.json">
    <link rel="mask-icon" href="/image/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
	<!--[if IE]>
        <script src="/js/html5shiv.js"></script>
        <link rel="stylesheet" href="/css/ie.css">
    <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<?= $content ?>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
