<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasuk */

$this->title = 'Edit Transaksi Masuk : TM-'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'TM-'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="transaksi-masuk-update">

    <?=
    $this->render('_formedit', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>

</div>
