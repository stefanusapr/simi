<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kidzen\dynamicform\DynamicFormWidget;
use app\models\TransaksiMasuk;
use app\models\TransaksiMasukDetail;
use yii\grid\GridView;

//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//var_dump($dataProvider->models);
//echo "<br><br>";
//var_dump($dataProvider);
//exit;
?>
<div class="barang-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['report-details', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?php
        //echo
//        Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Anda yakin ingin menghapus?',
//                'method' => 'post',
//            ],
//        ])
        ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> List Barang'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <div class="table-responsive">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'kode_barang',
                'nama',
                'stok',
                'merk',
                'jenis',
                'keterangan',
            ],
        ])
        ?>
    </div>

    <h4> Data Transaksi <?= $this->title ?> Masuk </h4>
    <?=
    GridView::widget([
        'dataProvider' => $dataProviderTM,
        'layout' => "{items}{summary}{pager}",
        'tableOptions' => [
            'class' => 'table table-striped table-bordered black',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'transaksiMasuk.tgl_masuk',
            'transaksiMasuk.vendor.nama',
            'jumlah',
            'keterangan',
        ],
    ]);
    ?>

    <h4> Data Transaksi <?= $this->title ?> Keluar </h4>
    <?=
    GridView::widget([
        'dataProvider' => $dataProviderTK,
        'layout' => "{items}{summary}{pager}",
        'tableOptions' => [
            'class' => 'table table-striped table-bordered black',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'transaksiKeluar.tgl_keluar',
            'transaksiKeluar.nama_penerima',
            'jumlah',
            'keterangan',
        ],
        'showFooter' => true,
        'showHeader' => true,
    ]);
    ?>
</div>