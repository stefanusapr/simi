<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelBarang, 'kode_barang')->textInput(['maxlength' => true, 'placeholder' => 'Kode Barang: AC123']) ?>

    <?= $form->field($modelBarang, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Barang']) ?>

    <?= $form->field($modelBarang, 'merk')->textInput(['maxlength' => true, 'placeholder' => 'Merk Barang']) ?> 

    <?=
    $form->field($modelBarang, 'jenis')->dropDownList([
        'Habis Pakai' => 'Habis Pakai',
        'Tidak Habis Pakai' => 'Tidak Habis Pakai',
    ]);
    ?>

    <?= $form->field($modelBarang, 'keterangan')->textarea(['placeholder' => 'Keterangan Barang']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['create', 'class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['create'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
