<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasuk */

$this->title = 'Tambah Transaksi Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-masuk-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>

</div>
