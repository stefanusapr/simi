<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasuk */

$this->title = 'Edit Transaksi Masuk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="transaksi-masuk-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>

</div>
