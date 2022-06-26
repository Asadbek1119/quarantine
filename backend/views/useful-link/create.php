<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsefulLink */

$this->title = Yii::t('app', 'Foydali havolalar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Foydali havolalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful-link-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
