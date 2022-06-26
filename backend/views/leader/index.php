<?php

use common\models\Leader;
use common\models\LeaderCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rahbarlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-index">

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
                'attribute' => 'image',
                'format' => ['image', ['width' => '70px', 'height' => '100px']],
            ],
            'name',
            'phone',
//            'email:email',
            [
                'label' => 'Kategoriya nomi',
                'attribute' => 'leader_category_id',
                'filter' => LeaderCategory::leaderCategories(),
                'value' => function ($model) {
                    return $model->leaderCategory->name;
                }
            ],
            [
                'label' => 'Holati',
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Leader::getStatusFilter(),
                'value' => static function (Leader $model) {
                    if ($model->status == Leader::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Leader::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
