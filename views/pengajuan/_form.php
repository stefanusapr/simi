<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use kartik\datecontrol\DateControl;
use yii\widgets\MaskedInput;
use app\models\Barang;

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
            $form->field($model, 'tgl_pengajuan')->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'ajaxConversion' => true,
                'autoWidget' => true,
                'language' => 'id',
                'displayFormat' => 'php:d-m-Y',
                'saveFormat' => 'php:Y-m-d',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ],
            ]);
            ?>
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
                <!--                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalBarang" id="myModalBarang">
                                    Tambah Barang Baru
                                </button>-->
                <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Barang', ['create-barang'], ['class' => 'btn btn-primary']) ?>

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
                        <div class="col-md-2">
                            <?=
                            $form->field($detail, "[{$i}]id_barang")->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Barang::find()->all(), 'id', 'nama', 'merk'),
                            ]);
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?=
                            $form->field($detail, "[{$i}]jumlah", [
                                'template' => '
                                                {label}
                                                <div class="input-group">
                                                   {input}
                                                   <span class="input-group-addon">
                                                      <span><b>Qty</b></span>
                                                   </span>
                                                </div>
                                                {error}{hint}
                                            '
                            ])->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                                    $form->field($detail, "[{$i}]harga_satuan", [
                                        'enableClientValidation' => false,
                                        'template' => '
                                            {label}
                                                <div class="input-group">
                                                   <span class="input-group-addon">
                                                      <span><b>Rp</b></span>
                                                   </span>
                                                   {input}
                                                </div>
                                                {error}{hint}
                                            '])
                                    ->textInput(['type' => 'number', 'data-default' => ''])
                                    ->widget(MaskedInput::classname(), [
                                        'clientOptions' => [
                                            'alias' => 'decimal',
                                            'groupSeparator' => '.',
                                            "digits" => 0,
                                            "autoGroup" => true,
                                            "removeMaskOnSubmit" => true,
                                            "rightAlign" => false,
                                            'allowMinus' => false,
                                        ],
                                    ])
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($detail, "[{$i}]keterangan")->textarea() ?>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button> 
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
        Html::submitButton('Ajukan', [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Anda yakin ingin mengajukan?',
                'method' => 'post',
            ],
        ]);
        ?>
        <?= Html::a(Yii::t('app', 'List Pengajuan'), ['index'], ['class' => 'btn btn-warning']) ?>     
    </div>

    <?php ActiveForm::end(); ?>

</div>
