<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

use kartik\daterange\DateRangePicker;
use kartik\datecontrol\DateControl;
use kartik\datecontrol\DateControlAsset;
use kartik\datecontrol\DateFormatterAsset;
use kartik\datecontrol\Module;


/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-keluar-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="row">
        <div class="col-md-3">
            <?=
            $form->field($model, 'cari')->textInput()->input('cari', [
                'placeholder' => "Pencarian"
            ])->label(false);
            ?>
        </div>

        <div class="col-md-3">
            <?php
            // DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
            echo '<div class="drp-container">';
            echo DateRangePicker::widget([
                'name' => 'date_range',
                'convertFormat' => true,
                'presetDropdown' => true,
                'hideInput' => true,
                'language' => 'id',
            ]);
            echo '</div>';
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
