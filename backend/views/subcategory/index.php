<?php

use common\models\Category;
use common\models\Subcategory;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subkategoriya');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-index">

    <p>
        <?= Html::a("<i class='fas fa-plus'></i> " . Yii::t('app', 'Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => ['class' => LinkPager::className()],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'slug',
            [
                'label' => 'Kategoriya nomi',
                'attribute' => 'category_id',
                'filter' => Category::categories(),
                'value' => function($model) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label' => 'Holati',
                'filter' => Subcategory::getStatusFilter(),
                'value' => static function (Subcategory $model) {
                    if ($model->status == Subcategory::STATUS_ACTIVE) {
                        return '<i class="badge badge-success">Faol</i>';
                    }
                    if ($model->status == Subcategory::STATUS_INACTIVE) {
                        return '<i class="badge badge-danger">Faol emas</i>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
