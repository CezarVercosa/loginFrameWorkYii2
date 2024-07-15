<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>
<p class="login-box-msg">Faça Login para iniciar a sessão</p>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'username', [
    'inputOptions' => [
        'class' => 'form-control',
        'placeholder' => $model->getAttributeLabel('username'),
    ],
])->label(false) ?>

<?= $form->field($model, 'password', [
    'inputOptions' => [
        'class' => 'form-control',
        'placeholder' => $model->getAttributeLabel('password'),
    ],
])->passwordInput()->label(false) ?>

<div class="row">
    <div class="col-4 mx-auto">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
