<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
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
        <?=
        Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus?',
                'method' => 'post',
            ],
        ])
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

    <div class="item panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-barcode"></i> Detail Transaksi Barang <?= $this->title ?> </h3>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row table-responsive">
                <div class="col-md-6">
                    <h5> <b> Transaksi Masuk </b> </h5>
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
                            [
                                'attribute' => 'tgl_masuk',
                                'value' => 'transaksiMasuk.tgl_masuk',
                                'header' => 'Tanggal',
                                'format' => ['date', 'php: d-m-Y'],
                            ],
                            'transaksiMasuk.vendor.nama',
                            'jumlah',
                            'thn_produksi',
                            'keterangan',
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <h5> <b> Transaksi Keluar </b> </h5>
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
                            [
                                'attribute' => 'tgl_keluar',
                                'value' => 'transaksiKeluar.tgl_keluar',
                                'header' => 'Tanggal',
                                'format' => ['date', 'php: d-m-Y'],
                            ],
                            'transaksiKeluar.nama_penerima',
                            'jumlah',
                            'keterangan',
                        ],
                        'showFooter' => true,
                        'showHeader' => true,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>