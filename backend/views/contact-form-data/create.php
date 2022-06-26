<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContactFormData */

$this->title = Yii::t('app', 'Forma malumotlari');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forma malumotlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form-data-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
