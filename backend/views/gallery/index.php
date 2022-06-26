<?php

use common\models\Gallery;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rasmlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

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
            'title',
            'slug',
            'created_at:datetime',
            //'updated_at',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Gallery::getStatusFilter(),
                'value' => static function (Gallery $model) {
                    if ($model->status == Gallery::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Gallery::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {img}',
                'buttons' => [
                    'img' => function ($url, $model) {
                        return Html::a('<i class="fas fa-image"></i>', ['gallery/img', 'id' => $model->id],
                            [
                                'title' => 'Rasm yuklash',
                                'data-pjax' => '0',
                                'data' => [
                                    'Rasm yuklamoqchimisiz?',
                                ],
                            ]);
                    }
                ]

            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
