<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peminjaman-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?=
    $form->field($model, 'cari')->textInput()->input('cari', [
        'placeholder' => "Pencarian"
    ])->label(false);
    ?>

    <?php ActiveForm::end(); ?>

</div>
