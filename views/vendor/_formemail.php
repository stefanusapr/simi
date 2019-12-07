<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($model, 'nama')->textInput(['disabled' => true])
    ?>
    
    <?=
    $form->field($model, 'email')->textInput(['disabled' => true])
    ?>

    <?=
    $form->field($model, 'judul')->textarea(['rows' => 2])
    ?>
    
    <?=
    $form->field($model, 'isi')->textarea(['rows' => 4])
    ?>


    <div class="form-group">
        <?=
        Html::submitButton('Kirim', [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Anda yakin ingin mengirim pesan ini?',
                'method' => 'post',
                'setuju' => 'true',
            ],
        ]);
        ?>
    <?= Html::a(Yii::t('app', 'List Vendor'), ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
