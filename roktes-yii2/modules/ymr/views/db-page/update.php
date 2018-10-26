<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\for_page\models\DbPage */

$this->title = 'Update Db Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Db Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="db-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats,
        'types' => $types,
    ]) ?>

</div>
