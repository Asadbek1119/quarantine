<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BannerImage */

$this->title = Yii::t('app', 'Banner rasmlari');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banner rasmlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-image-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
