<?php

use common\models\Symbols;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Symbols */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Davlat ramzlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symbols-index">

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
            [
                'label' => 'Rasm',
                'attribute' => 'image',
                'format' => ['image', ['width' => '70px', 'height' => '70px']]
            ],
            'music',
            //'content',
            'slug',
            [
                'label' => 'Holati',
                'attribute' => 'status',
                'filter' => Symbols::getStatusFilter(),
                'value' => static function ($model) {
                    return $model->getStatusLabel();
                }
            ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
