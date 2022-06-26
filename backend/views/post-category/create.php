<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostCategory */

$this->title = Yii::t('app', 'Post Kategoriyasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Kategoriyasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
