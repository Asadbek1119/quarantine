<?php

use common\models\UsefulLink;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UsefulLink */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Foydali havolalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful-link-index">

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
            'url_name:url',
            'name',
            [
                'attribute' => 'status',
                'filter' => UsefulLink::getStatusFilter(),
                'value' => static function ($model) {
                    return $model->getStatusLabel();
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UsefulLink $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
