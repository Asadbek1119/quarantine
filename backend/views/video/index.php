<?php

use common\models\Subcategory;
use common\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Videolar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

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
            //'slug',
            'video_url:url',
            'name',
            'video_content',
            'created_at:datetime',
            //'updated_at',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label' => 'Holati',
                'filter' => Video::getStatusFilter(),
                'value' => static function (Video $model) {
                    if ($model->status == Video::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Video::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
