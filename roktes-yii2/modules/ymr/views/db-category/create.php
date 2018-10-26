<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\for_category\models\DbCategory */

$this->title = 'Create Db Category';
$this->params['breadcrumbs'][] = ['label' => 'Db Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'item_menu' => $item_menu,
    ]) ?>

</div>
