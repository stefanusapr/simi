<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

$this->title = 'Tambah Vendor dari transaksi';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-create">
<!-- 
    <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formvendor', [
        'modelVendor' => $modelVendor,
    ]) ?>

</div>
