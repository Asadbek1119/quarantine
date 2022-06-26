<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LeaderCategory */

$this->title = Yii::t('app', 'Rahbariyat kategoriyasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rahbariyat kategoriyasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
