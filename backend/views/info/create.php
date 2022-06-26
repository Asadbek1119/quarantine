<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Info */

$this->title = Yii::t('app', 'Malumotlar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Malumotlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
