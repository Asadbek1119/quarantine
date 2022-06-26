<?php

use common\models\Downloads;
use common\models\Subcategory;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DownloadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Yuklanmalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="downloads-index">

    <p>
        <?= Html::a("<i class='fas fa-plus'></i> " . Yii::t('app', 'Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'file_icon',
            'file_name',
//            'file_download',
            [
                'label' => 'Kategoriya nomi',
                'attribute' => 'subcategory_id',
                'filter' => Subcategory::subcategories(),
                'value' => function ($model) {
                    return $model->subcategory->name;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label' => 'Holati',
                'filter' => Downloads::getStatusFilter(),
                'value' => static function (Downloads $model) {
                    if ($model->status == Downloads::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Downloads::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
