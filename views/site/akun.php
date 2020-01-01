<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Pengaturan Akun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-cog"></i></h3>
        <div class="clearfix"></div>
    </div>
    <div class="row panel-body">
        <div class="col-md-5">
            <?php
            $form = ActiveForm::begin([
                        'id' => 'changepassword-form',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-md-7\">
                        {input}</div>\n<div class=\"col-md-7 pull-right\">
                        {error}</div>",
                            'labelOptions' => ['class' => 'col-md-5 control-label'],
                        ],
            ]);
            ?>
            <?=
            $form->field($model, 'old_password', ['inputOptions' => [
                    'placeholder' => 'Kata sandi lama']])->passwordInput()
            ?>

            <?=
            $form->field($model, 'new_password', ['inputOptions' => [
                    'placeholder' => 'Kata sandi baru']])->passwordInput()
            ?>

            <?=
            $form->field($model, 'repeat_password', ['inputOptions' => [
                    'placeholder' => 'Ulangi kata sandi baru']])->passwordInput()
            ?>

            <div class="form-group">
                <div class="pull-right">
                    <?=
                    Html::submitButton('Ganti kata sandi', [
                        'class' => 'btn btn-primary',
                        'style' => 'margin-right: 15px',
                    ])
                    ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-5">
            <?php if (Yii::$app->user->identity->AuthKey == 'test100key'): ?>
                <br>
                <br>
                <?php
                $form = ActiveForm::begin([
                            'id' => 'changeemail-form',
                            'action' => ['change-mail'],
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class = \"col-md-7\">
                            {input}</div>\n<div class=\"col-md-7 pull-right\">
                            {error}</div>",
                                'labelOptions' => ['class' => 'col-md-5 control-label'],
                            ],
                ]);
                ?>
                <?=
                $form->field($model, 'new_email', ['inputOptions' => [
                        'placeholder' => 'Ganti email baru']])
                ?>

                <?=
                $form->field($model, 'old_password', ['inputOptions' => [
                        'placeholder' => 'Konfirmasi Password']])->passwordInput()
                ?>

                <div class="form-group">
                    <div class="pull-right">
                        <?=
                        Html::submitButton('Ganti email', [
                            'class' => 'btn btn-primary',
                            'style' => 'margin-right: 15px',
                        ])
                        ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            <?php endif ?>
        </div>
    </div>
</div>