<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subcategory */

$this->title = Yii::t('app', 'Subkategoriya');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subkategoriya'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
