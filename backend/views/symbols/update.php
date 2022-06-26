<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Symbols */

$this->title = Yii::t('app', 'Davlat ramzlari: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Davlat ramzlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="symbols-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
