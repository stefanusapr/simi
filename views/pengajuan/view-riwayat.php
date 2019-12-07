<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuan */

$this->title = 'TP-' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Riwayat Pengajuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pengajuan-view">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['#', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> Riwayat Pengajuan'), ['riwayat'], ['class' => 'btn btn-warning']) ?>
    </p>  

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'tgl_pengajuan',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            [
                'attribute' => 'tgl_spk',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            [
                'attribute' => 'tgl_persetujuan',
                'format' => ['date', 'php: d-m-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            'keterangan',
        ],
    ])
    ?>
    <div class="item panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-barcode"></i> Detail Pengajuan</h3>
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
                    'keterangan',
                    [
                        'attribute' => 'status',
                        'value' => 'StatusLabel',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>