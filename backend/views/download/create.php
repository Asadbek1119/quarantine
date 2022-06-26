<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Downloads */

$this->title = Yii::t('app', 'Yuklanmalar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yuklanmalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="downloads-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
