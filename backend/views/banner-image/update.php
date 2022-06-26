<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BannerImage */

$this->title = Yii::t('app', 'Tahrirlash: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banner rasmlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="banner-image-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
