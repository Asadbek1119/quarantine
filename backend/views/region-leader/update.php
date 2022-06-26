<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegionLeader */

$this->title = Yii::t('app', 'Tahrirlash: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hudud rahbarlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="region-leader-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
