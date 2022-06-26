<?php

use common\models\ContactFormData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ContactFormData */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Forma malumotlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form-data-index">

    <p>
        <?= Html::a("<i class='fas fa-plus'></i>" . Yii::t('app', ' Yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => static function (ContactFormData $model) {
                    if ($model->status === ContactFormData::STATUS_ACTIVE)
                        return ['style' => 'background:lightgreen'];

                    return ['style' => 'background:#ff726f'];
                }
            ],

            //'id',
            'username',
            //'email:email',
            'phone',
            //'message:ntext',
            'created_at',
            [
                'attribute' => 'status',
                'filter' => ContactFormData::getStatusFilter(),
                'value' => static function (ContactFormData $model) {
                    return $model->getStatusLabel();
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' =>
                    [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url);
                        }
                    ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
