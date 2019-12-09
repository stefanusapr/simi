<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

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
    $form->field($kirimPesan, 'judul')->textarea(['rows' => 2])
    ?>

    <?=
    $form->field($kirimPesan, 'isi_pesan')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'id',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);
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
