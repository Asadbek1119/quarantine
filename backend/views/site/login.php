<?php
use yii\helpers\Html;

$this->title = 'Tizimga Kirish';
?>

<div class="row mt-5">

    <div class="col-md-3"></div>

    <div class="col-md-5">
        <div class="d-flex" style="margin-left: 100px;">
            <img src="/template/images/protection.png" alt="img" style="margin-top: -15px; margin-right: 10px; width: 60px; height: 60px">
            <h3 class="text-center mb-4" style="color: #3CB371">QUARANTINE</h3>
        </div>
        <div class="card mt-1">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg" style="text-align: center; color: #a0a0a0">Tizimga kirish</h5>

                <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

                <?= $form->field($model,'username', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><img src="/template/images/login.png" alt="" style="width: 20px; height: 20px; color: #a0a0a0"></div></div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('Login')]) ?>

                <?= $form->field($model, 'password', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><img src="/template/images/password.png" alt="" style="width: 20px; height: 20px; color: #a0a0a0"></div></div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])
                    ->label(false)
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('Parol')]) ?>

                <div class="row">
                    <div class="col-4 offset-8">
                        <?= Html::submitButton('Kirish', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                </div>

                <?php \yii\bootstrap4\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
