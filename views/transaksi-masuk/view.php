<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasuk */

$this->title = $model->tgl_masuk;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaksi-masuk-view">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-eye-open"></span> List Transaksi'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'tgl_spk',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            [
                'attribute' => 'tgl_masuk',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            [
                'label' => 'Nama Vendor',
                'attribute' => 'vendor.nama',
            ],
            'no_faktur',
            [
                'attribute' => 'tgl_faktur',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            'no_berita_acara',
            [
                'attribute' => 'tgl_berita_acara',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            'no_pemeriksaan',
            [
                'attribute' => 'tgl_pemeriksaan',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
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
                    'harga_satuan',
                    [
                        'header' => 'Total Harga',
                        'value' => function ($modelDetail) {
                            return $modelDetail->jumlah * $modelDetail->harga_satuan;
                        }
                    ],
                    'thn_produksi',
                    'keterangan',
                ],
            ]);
            ?>
        </div>
    </div>

</div>
