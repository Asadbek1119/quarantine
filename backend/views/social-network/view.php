<?php

use common\models\SocialNetwork;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SocialNetwork */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Social Networks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="social-network-view">

    <p>
        <?= Html::a("<i class='fas fa-pencil-alt'></i> " . Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("<i class='fas fa-trash-alt'></i> " . Yii::t('app', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Haqiqatan ham bu elementni oʻchirib tashlamoqchimisiz?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url_name:url',
            'icon_code',
            [
                'attribute' => 'statusLabel',
                'label' => 'Holati'
            ],
        ],
    ]) ?>

</div>
