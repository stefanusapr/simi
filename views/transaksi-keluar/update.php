<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluar */

$this->title = 'Edit Transaksi Keluar: TK-'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'TK-'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="transaksi-keluar-update">
    <?=
    $this->render('_formedit', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>
</div>
