<?php

use common\models\LeaderCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LeaderCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rahbariyat kategoriyasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-category-index">

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

            //'id',
            'name',
            'slug',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label' => 'Holati',
                'filter' => LeaderCategory::getStatusFilter(),
                'value' => static function (LeaderCategory $model) {
                    if ($model->status == LeaderCategory::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == LeaderCategory::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
