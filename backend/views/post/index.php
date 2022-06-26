<?php

use common\models\Post;
use common\models\PostCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Yangiliklar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <p>
        <?= Html::a("<i class='fas fa-plus'></i> " . Yii::t('app', ' Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'format' => ['image', ['width' => '100']],
            ],
            'title',
//            'slug',
            'created_at:datetime',
            //'updated_at:datetime',
            [
                'label' => 'Kategoriya nomi',
                'attribute' => 'post_category_id',
                'filter' => PostCategory::categories(),
                'value' => static function ($model) {
                    return $model->postCategory->name;
                }
            ],
            [
                'label' => 'Holati',
                'attribute' => 'status',
                'filter' => Post::getStatusFilter(),
                'value' => static function ($model) {
                    return $model->getStatusLabel();
                }
            ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
