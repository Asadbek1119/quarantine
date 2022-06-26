<?php

use common\models\Info;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malumotlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-index">

    <p>
        <?= Html::a("<i class='fas fa-plus'></i> " . Yii::t('app', ' Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => ['class' => LinkPager::class],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
            'created_at:date',
            'updated_at:date',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Info::getStatusFilter(),
                'value' => static function (Info $model) {
                    if ($model->status == Info::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Info::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
