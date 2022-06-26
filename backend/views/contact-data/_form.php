<?php

use yii\helpers\Html;
use yeesoft\multilingual\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-data-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->languageSwitcher($model)?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_first')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_second')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lunch_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'download')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
