<?php

use common\models\BannerImage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BannerImage */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banner rasmlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-image-index">

    <p>
        <?= Html::a("<i class='fas fa-plus'></i> " . Yii::t('app', 'Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Rasm',
                'attribute' => 'image',
                'format' => ['image', ['width' => '70px', 'height' => '70px']],
            ],
            [
                'label' => 'Holati',
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => BannerImage::getStatusFilter(),
                'value' => static function (BannerImage $model) {
                    if ($model->status == BannerImage::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == BannerImage::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
