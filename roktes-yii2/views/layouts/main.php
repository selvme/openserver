<?php
use app\widgets\RoktesBreadcrumbs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\modules\for_menu\Choice_Menu;
use app\widgets\Footer;
use app\widgets\HeaderForm;


AppAsset::register($this);

$menu_items = Choice_Menu::viewMenuItems('main', true);

if (!Yii::$app->user->isGuest) {
    array_push($menu_items, 
        [
            'label' => 'ADMIN',
            'url' => '#',
            'items' => [
                ['label' => 'Product', 'url' => Url::home() . 'ymr/db-page/index'],
                ['label' => 'Logout', 'url' =>  Url::home() . 'logout'],
            ],
        ]
    );
}

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
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]>
        <script src="/js/html5shiv.js"></script>
        <link rel="stylesheet" href="/css/ie.css">
    <![endif]-->
    <noscript><div><img src="https://mc.yandex.ru/watch/7831060" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <header class="page-header">
        <div class="container">
            <div class="page-header__inner row">
            <div class="sitename row col-lg-5 col-md-6 col-xs-7 col-phone">
                <div class="sitename-title col-lg-6 col-md-12 col-xs-12">
                    <a href="<?= Url::home() ?>" title="Роктес | Главная" rel="home">
                        <img src="/image/logo.png" alt="Роктес" class="img-responsive" />
                    </a>
                </div>
                <div class="sitename-slogan col-lg-6 col-md-0 col-sm-0 col-xs-0">Металлообрабатывающее оборудование из Китая
                </div>
            </div>
            <div class="header-content-block col-lg-2 col-md-0">
                <?= HeaderForm::widget(); ?>           
            </div>
            <div class="header-content-block col-lg-2 col-md-3 col-sm-0 col-xs-0">
                Пишите, ответим в течение 30 мин 
                <b>
                    <a href="mailto:offer&#64;roktes&#46;ru" class="text-color-dark-red" rel="nofollow" onclick="yaCounter7831060.reachGoal('contacts');">offer&#64;roktes&#46;ru</a>
                </b>           
            </div>
            <div class="header-content-block col-lg-3 col-md-3 col-xs-5 col-none">
                Челябинск: с 8:00 до 17:00 
                <p>
                    <b>
                        <a href="tel:+88003333589" rel="nofollow" onclick="yaCounter7831060.reachGoal('contacts');"><span class="text-color-light-blue">8 (800)</span> <span class="text-color-dark-red">333-35-89</span></a>
                    </b>
                </p>          
            </div>
            </div>
        </div>
        <?php
        NavBar::begin([
            'brandLabel' => '<img src="/image/navbar-icon1.png" class="img-responsive"/>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [ 
                'id' => 'main',
            ],
            'renderInnerContainer' => false,
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menu_items,
        ]);
        NavBar::end();
        ?>              
    </header>
    <? if (isset($this->params['breadcrumbs'])) :?>
        <div class="container">
            <?= RoktesBreadcrumbs::widget([
                    'homeLink' => [
                        'label' => 'Главная',
                        'url' => Url::home(true),
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
        </div>
    <? endif;?>
    <div id="content">
        <?= $content ?>
    </div>
    <footer>
        <?= Footer::widget() ?>
    </footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
