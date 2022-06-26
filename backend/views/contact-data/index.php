<?php

use common\models\ContactData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ContactData */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kontakt malumotlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-data-index">

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
            'address',
            'destination',
            'email:email',
            'phone_first',
//            'phone_second',
            'lunch_time',
            //'download',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ContactData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
