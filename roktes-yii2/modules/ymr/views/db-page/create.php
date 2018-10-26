<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\for_page\models\DbPage */

$this->title = 'Create Db Page';
$this->params['breadcrumbs'][] = ['label' => 'Db Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats,
        'types' => $types,
    ]) ?>

</div>
