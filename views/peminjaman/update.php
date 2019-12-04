<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluar */

$this->title = 'Edit Transaksi Keluar: ' . $model->tgl_keluar;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="transaksi-keluar-update">
    <?=
    $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>
</div>