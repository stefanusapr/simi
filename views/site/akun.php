<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Pengaturan Akun';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="changepassword">

    <?php
    $form = ActiveForm::begin([
                'id' => 'changepassword-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-md-3\">
                        {input}</div>\n<div class=\"col-md-5\">
                        {error}</div>",
                    'labelOptions' => ['class' => 'col-md-2 control-label'],
                ],
    ]);
    ?>
    <?=
    $form->field($model, 'password_old', ['inputOptions' => [
            'placeholder' => 'Kata sandi lama']])->passwordInput()
    ?>

    <?=
    $form->field($model, 'password_new', ['inputOptions' => [
            'placeholder' => 'Kata sandi baru']])->passwordInput()
    ?>

    <?=
    $form->field($model, 'password_repeat', ['inputOptions' => [
            'placeholder' => 'Ulangi kata sandi baru']])->passwordInput()
    ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-11">
            <?=
            Html::submitButton('Ganti kata sandi', [
                'class' => 'btn btn-primary'
            ])
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

