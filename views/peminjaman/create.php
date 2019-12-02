<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluar */

$this->title = 'Tambah Transaksi Keluar';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-keluar-create">
<!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>

</div>
