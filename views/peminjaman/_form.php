<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use app\models\Barang;
use app\models\TransaksiKeluarDetail;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peminjaman-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <!-- nama penerima -->
        <div class="col-md-4">
            <?= $form->field($model, 'nama_penerima')->textInput(['maxlength' => true, 'disabled' => true]) ?>
        </div>
        <!--tgl keluar-->
        <div class="col-md-4">
            <?=
            $form->field($model, 'tgl_keluar')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => date('Y-m-d'),
                'disabled' => true,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>
        </div>

        <!-- tgl surat -->
        <div class="col-md-4">
            <?=
            $form->field($model, 'tgl_surat')->widget(DatePicker::className(), [
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => date('Y-m-d'),
            'disabled' => true,
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
            <?= $form->field($model, "keterangan")->textarea() ?>
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
            'keterangan',
            'tgl_kembali',
        ],
    ]);
    ?>

    <div class="panel panel-default">    <!-- panel default  -->
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="glyphicon glyphicon-th-list"></i> Detail Transaksi</h4>
            <div class="btn-group pull-right">
                <a href="#" class="btn btn-primary btn-sm"> Tambah Barang</a>
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
                                'disabled' => true,
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($detail, "[{$i}]jumlah")->textInput(['maxlength' => true, 'disabled' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($detail, "[{$i}]keterangan")->textarea(['disabled' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($detail, "[{$i}]tgl_kembali")->widget(DatePicker::className(), [
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
                        <!--                        <div class="col-md-1 item-action">
                                                    <div class="pull-right">
                                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button> 
                                                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                                    </div>
                                                </div>-->
                    </div>
                    <!-- .row -->
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div> <!-- panel body -->
    </div> <!-- panel default -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'List Peminjaman'), ['index'], ['class' => 'btn btn-warning']) ?>     
    </div>

    <?php ActiveForm::end(); ?>

</div>
