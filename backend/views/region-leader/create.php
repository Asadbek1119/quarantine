<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegionLeader */

$this->title = Yii::t('app', 'Hudud rahbarlari');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hudud rahbarlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-leader-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
