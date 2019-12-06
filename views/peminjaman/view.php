<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluar */

$this->title = 'TK-' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Riwayat Peminjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="peminjaman-view">
    <p>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-eye-open"></span> List Riwayat Peminjaman'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'tgl_keluar',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            [
                'attribute' => 'tgl_surat',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            'nama_penerima',
        ],
    ])
    ?>

    <div class="item panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-barcode"></i> Detail Transaksi</h3>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $modelDetail,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
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
                    'jumlah',
                    [
                        'attribute' => 'tgl_kembali',
                        'format' => ['date', 'php: d-m-Y'],
                        'header' => 'Tanggal Pengembalian',
                    ],
                    'keterangan',
                ],
            ]);
            ?>
        </div>
    </div>

</div>
