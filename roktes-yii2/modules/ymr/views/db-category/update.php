<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\for_category\models\DbCategory */

$this->title = 'Update Db Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Db Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="db-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
