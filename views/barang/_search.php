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

<!--    <div class="col-md-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Pencarian">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button">Cari</button>
            </span>
        </div> /input-group 
    </div> /.col-lg-6 -->

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'cari')->label('Pencarian') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
