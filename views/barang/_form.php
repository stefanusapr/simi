<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_barang')->textInput(['maxlength' => true, 'placeholder' => 'Kode Barang: AC123']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Barang']) ?>

    <?= $form->field($model, 'stok')->textInput(['placeholder' => '100']) ?>

    <?= $form->field($model, 'merk')->textInput(['maxlength' => true, 'placeholder' => 'Merk Barang']) ?> 

    <?=
    $form->field($model, 'jenis')->dropDownList([
        'Habis Pakai' => 'Habis Pakai',
        'Tidak Habis Pakai' => 'Tidak Habis Pakai',
    ]);
    ?>

    <?= $form->field($model, 'keterangan')->textarea(['placeholder' => 'Keterangan Barang']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'List Barang'), ['index'], ['class' => 'btn btn-warning']) ?>     
    </div>

    <?php ActiveForm::end(); ?>

</div>
