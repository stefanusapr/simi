<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelVendor, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Toko ABC'])?>

    <?= $form->field($modelVendor, 'no_hp')->textInput(['maxlength' => true, 'placeholder' => '0341123456789']) ?>

    <?= $form->field($modelVendor, 'email')->textInput(['maxlength' => true, 'placeholder' => 'contoh@gmail.com']) ?>

    <?= $form->field($modelVendor, 'alamat')->textarea(['rows' => 2, 'placeholder' => "Jalan Raya Indonesia" ]) ?>

    <?= $form->field($modelVendor, 'keterangan')->textarea(['rows' => 2, 'placeholder' => "Keterangan Toko"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['create', 'class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['create'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
