<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index">

    <div class="row">
        <div class="col-md-4">
            <p>
                <?= Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['report'], ['class' => 'btn btn-info']) ?>
            </p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_search', ['model' => $searchModel, 'action' => 'index-riwayat']); ?>
        </div>
    </div>
    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_transaksi_keluar',
                'header' => 'Kode',
                'value' => function ($dataProvider) {
                    return 'TK-' . $dataProvider->transaksiKeluar->id;
                }
            ],
            [
                'attribute' => 'transaksiKeluar.tgl_keluar',
                'format' => ['date', 'php: d-m-Y'],
                'label' => 'Tanggal peminjaman',
            ],
            [
                'attribute' => 'tgl_kembali',
                'format' => ['date', 'php: d-m-Y'],
            ],
            'transaksiKeluar.nama_penerima',
            'barang.nama',
            'jumlah',
            'keterangan',
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:100px, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Lihat', ['view', 'id' => $model->id_transaksi_keluar], ['class' => 'btn btn-success',]);
                    },
                ]
            ],
        ],
    ]);
    ?>


</div>
