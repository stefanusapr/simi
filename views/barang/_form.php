<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_barang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stok')->textInput() ?>

    <?= $form->field($model, 'merk')->textInput(['maxlength' => true]) ?> 

    <?=
    $form->field($model, 'jenis')->dropDownList([
        'Habis Pakai' => 'Habis Pakai',
        'Tidak Habis Pakai' => 'Tidak Habis Pakai',
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'List Barang'), ['index'], ['class' => 'btn btn-warning']) ?>     
    </div>

    <?php ActiveForm::end(); ?>

</div>
