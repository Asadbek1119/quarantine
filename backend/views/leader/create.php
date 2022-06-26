<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Leader */

$this->title = Yii::t('app', 'Create Leader');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rahbarlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
