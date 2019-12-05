<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use app\models\Barang;
use app\models\Pengajuan;
use app\models\PengajuanBarang;
use app\models\PengajuanBarangSearch;
use app\controllers\PengajuanController;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuan-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <!-- tgl pengajuan -->
        <div class="col-md-4">
            <?=
            $form->field($model, 'tgl_pengajuan')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => date('Y-m-d'),
                'disabled' => 'true',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>
        </div>

        <!-- tgl persetujuan -->
        <div class="col-md-4">
            <?=
            $form->field($model, 'tgl_persetujuan')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>
        </div>

        <!-- tgl spk -->
        <div class="col-md-4">
            <?=
            $form->field($model, 'tgl_spk')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'keterangan')->textarea() ?>
        </div>
    </div>


    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-item', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 999, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id_barang',
            'jumlah',
            'harga_satuan',
        ],
    ]);
    ?>

    <div class="panel panel-default">    <!-- panel default  -->
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="glyphicon glyphicon-th-list"></i> Detail Pengajuan</h4>
            <div class="btn-group pull-right">
                <!-- Button trigger modal -->

            </div>
        </div>
        <!-- panel body -->
        <div class="panel-body"> 
            <div class="container-item"><!-- widgetContainer -->
                <?php foreach ($modelDetail as $i => $detail): ?>
                    <!-- row -->
                    <div class="item row">
                        <?php
                        // untuk aksi update
                        if (!$detail->isNewRecord) {
                            echo Html::activeHiddenInput($detail, "[{$i}]id");
                        }
                        ?>
                        <div class="col-md-3">
                            <?=
                            $form->field($detail, "[{$i}]id_barang")->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Barang::find()->all(), 'id', 'nama'),
                                'disabled' => 'true',
                            ]);
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($detail, "[{$i}]jumlah")->textInput(['maxlength' => true, 'disabled' => 'true']) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($detail, "[{$i}]harga_satuan")->textInput(['maxlength' => true, 'disabled' => 'true']) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($detail, "[{$i}]keterangan")->textarea(['disabled' => 'true']) ?>
                        </div>
                        <div class="col-md-2">
                            <?=
                            $form->field($detail, "[{$i}]status")->radioList(array(1 => ' Setuju ', 0 => ' Tolak '));
                            ?>
                        </div>
                    </div>
                    <!-- .row -->
                <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div> <!-- panel body -->
    </div> <!-- panel default -->

    <div class="form-group">
        <?=
        Html::submitButton('Simpan', [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Anda yakin ingin memberikan persetujuan?',
                'method' => 'post',
                'setuju' => 'true',
            ],
        ]);
        ?>
        <?= Html::a(Yii::t('app', 'List Pengajuan'), ['index'], ['class' => 'btn btn-warning']) ?>     
    </div>
    <?php ActiveForm::end(); ?>

</div>
