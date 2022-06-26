<?php

use common\models\Downloads;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Downloads */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Downloads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="downloads-view">

    <p>
        <?= Html::a("<i class='fas fa-pencil-alt'></i> ".Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("<i class='fas fa-trash-alt'></i> ".Yii::t('app', 'O\'chirish'), ['delete', 'id' => $model->id], [
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
            'file_icon',
            'file_name',
            'file_download',
            'subcategory.name',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label' => 'Holati',
                'value' => static function (Downloads $model) {
                    if ($model->status == Downloads::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Downloads::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
        ],
    ]) ?>

</div>
