<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContactFormData */

$this->title = Yii::t('app', 'Tahrirlash: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forma malumotlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="contact-form-data-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
