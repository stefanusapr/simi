<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-masuk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl_spk') ?>

    <?= $form->field($model, 'tgl_masuk') ?>

    <?= $form->field($model, 'id_vendor') ?>

    <?= $form->field($model, 'no_faktur') ?>

    <?php // echo $form->field($model, 'tgl_faktur') ?>

    <?php // echo $form->field($model, 'no_berita_acara') ?>

    <?php // echo $form->field($model, 'tgl_berita_acara') ?>

    <?php // echo $form->field($model, 'no_pemeriksaan') ?>

    <?php // echo $form->field($model, 'tgl_pemeriksaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
