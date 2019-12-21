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

<div class="peminjaman-search">

    <?php
    $form = ActiveForm::begin([
                'action' => $action,
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
        <div class="col-md-4 col-md-offset-4">
            <div class="drp-container">
                <div class="input-group">
                    <?=
                    DateRangePicker::widget([
                        'model' => $model,
                        'language'=> 'id',
                        'attribute' => 'createTimeRange',
                        'presetDropdown' => true,
                        'pluginOptions' => [
                            'opens' => 'right',
                            'locale' => [
                                'format' => 'Y-M-D',
                            ]
                        ]
                    ]);
                    ?>
                    <div class="input-group-btn">
                        <?= Html::submitButton('', ['class' => 'btn btn-primary glyphicon glyphicon-search']) ?>
                        <?= Html::a('Reset', [$action], ['class' => 'btn btn-default']); ?>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <?php ActiveForm::end(); ?>

</div>
