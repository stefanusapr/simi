<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <!-- <div class="col-md-4">
                    <p>
        <?php // Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['#'], ['class' => 'btn btn-info']) ?>
                    </p>
                </div>-->
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'tgl_keluar',
                'value' => 'transaksiKeluar.tgl_keluar',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'tgl_kembali',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'id_transaksi_keluar',
                'value' => 'transaksiKeluar.nama_penerima',
                'header' => 'Nama Peminjam',
            ],
            [
                'attribute' => 'id_barang',
                'value' => 'barang.kode_barang',
                'header' => 'Kode Barang',
            ],
            [
                'attribute' => 'id_barang',
                'value' => 'barang.nama',
                'header' => 'Nama Barang',
            ],
            [
                'attribute' => 'jumlah',
                'header' => 'Jumlah',
            ],
            [
                'attribute' => 'keterangan',
                'header' => 'Keterangan',
            ],
        ],
    ]);
    ?>


</div>
