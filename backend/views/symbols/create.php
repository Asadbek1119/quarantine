<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Symbols */

$this->title = Yii::t('app', 'Davlat ramzlari');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Davlat ramzlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symbols-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
