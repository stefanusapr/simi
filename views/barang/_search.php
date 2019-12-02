<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-search">

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
    
<!--    <div class="form-group">
//harunya ? itu =
        <?php //echo Html::submitButton('Cari', ['class' => 'btn btn-primary']); ?>
        <?php //echo Html::a('Reset', ['index'], ['class' => 'btn btn-default']); ?>
    </div>-->

    <?php ActiveForm::end(); ?>

</div>
