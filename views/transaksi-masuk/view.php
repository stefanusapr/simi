<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiMasuk */

$this->title = 'TM-' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaksi-masuk-view">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> List Transaksi'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'tgl_masuk',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            [
                'attribute' => 'tgl_spk',
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
            <div class="table-responsive">
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
                            'attribute' => 'harga_satuan',
                            'value' => function ($modelDetail) {
                                return Yii::$app->formatter->asCurrency($modelDetail->harga_satuan);
                            }
                        ],
                        [
                            'header' => 'Total Harga',
                            'value' => function ($modelDetail) {
                                $temp = $modelDetail->jumlah * $modelDetail->harga_satuan;
                                return Yii::$app->formatter->asCurrency($temp);
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
</div>
