<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Toko ABC'])?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true, 'placeholder' => '0341123456789']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'contoh@gmail.com']) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 2, 'placeholder' => "Jalan Raya Indonesia" ]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 2, 'placeholder' => "Keterangan Toko"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambahkan') : Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a( 'Batal', Yii::$app->request->referrer, ['class'=>'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
