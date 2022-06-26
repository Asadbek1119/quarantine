<?php

use common\models\Region;
use common\models\RegionLeader;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RegionLeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hudud rahbarlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-leader-index">

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
            [
                'label' => 'Rasm',
                'attribute' => 'image',
                'format' => ['image', ['width' => '70px', 'height' => '100px']],
            ],
            'name',
            'phone',
            'fax',
            //'email:email',
            [
                'label' => 'Hudud nomi',
                'attribute' => 'region_id',
                'filter' => Region::getRegions(),
                'value' => function ($model) {
                    return $model->region->region_name;
                }
            ],
            [
                'label' => 'Holati',
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => RegionLeader::getStatusFilter(),
                'value' => static function (RegionLeader $model) {
                    return $model->getStatusLabel();
                }
            ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
