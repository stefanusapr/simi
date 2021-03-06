<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use app\models\Barang;
use app\models\Vendor;
use yii\helpers\Url;

use kartik\datecontrol\DateControl;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasuk */
/* @var $form yii\widgets\ActiveForm */
$js = <<< JS
    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {

        $(item).find("input[name*='[harga_satuan]']").inputmask({
            "alias":"decimal",
            "groupSeparator":".",
            "digits":0,
            "autoGroup":true,
            "removeMaskOnSubmit":true,
            "rightAlign":false,
            "allowMinus":false
        });
    });
JS;
$this->registerJs($js, \yii\web\View::POS_LOAD);
?>

<div class="transaksi-masuk-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-md-6">
            <!--tgl masuk barang-->
            <div class="col-md-12">
                <?=
                $form->field($model, 'tgl_masuk')->widget(DateControl::classname(), [
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
        <div class="col-md-6">
            <!--tgl spk-->
            <div class="col-md-12">
                <?=
                $form->field($model, 'tgl_spk')->widget(DateControl::classname(), [
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
    </div>

    <div class="row">
        <div class="col-md-3">
            <!--nama vendor-->
            <div class="col-md-12">
                <?=
                $form->field($model, 'id_vendor')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Vendor::find()->all(), 'id', 'nama'),
                ]);
                ?>
            </div>

            <!--btn nama vendor baru-->
            <div class="col-md-12" >
                <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Vendor', ['create-vendor'], ['class' => 'btn btn-primary']) ?>

            </div>
        </div>

        <div class="col-md-3">
            <!-- tgl faktur -->
            <div class="col-md-12">
                <?=
                $form->field($model, 'tgl_faktur')->widget(DateControl::classname(), [
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

            <!-- no faktur -->
            <div class="col-md-12">
                <?= $form->field($model, 'no_faktur')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="col-md-3">
            <!-- tgl berita acara masuk -->
            <div class="col-md-12">
                <?=
                $form->field($model, 'tgl_berita_acara')->widget(DateControl::classname(), [
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

            <!-- no berita acara -->
            <div class="col-md-12">
                <?= $form->field($model, 'no_berita_acara')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="col-md-3">
            <!-- tgl pemeriksaan -->
            <div class="col-md-12">
                <?=
                $form->field($model, 'tgl_pemeriksaan')->widget(DateControl::classname(), [
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

            <!-- no pemeriksaan -->
            <div class="col-md-12">
                <?= $form->field($model, 'no_pemeriksaan')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <?= $form->field($model, "keterangan")->textarea() ?>
            </div>
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
        ],
    ]);
    ?>

    <div class="panel panel-default">    <!-- panel default  -->
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="glyphicon glyphicon-th-list"></i> Detail Transaksi</h4>
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <?= $form->field($detail, "[{$i}]thn_produksi")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($detail, "[{$i}]keterangan")->textarea() ?>
                        </div>
                        <div class="col-md-1 item-action">
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button> 
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->
                <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div> <!-- panel body -->
    </div> <!-- panel default -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'List Transaksi Masuk'), ['index'], ['class' => 'btn btn-warning']) ?>     
    </div>

    <?php ActiveForm::end(); ?>

</div>