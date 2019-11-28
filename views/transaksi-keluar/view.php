<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiKeluar */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaksi-keluar-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakiningin menghapus?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tgl_keluar',
            [
                'attribute' => 'tgl_keluar',
                'format' => ['date', 'php: d-M-Y'],
                'labelColOptions' => ['style' => 'width:30%; text-align:right;']
            ],
            'tgl_surat',
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
                'dataProvider' => $details,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id_barang',
                        'value' => 'kode_barang',
                        'header' => 'Kode Barang',
                    ],
                    [
                        'attribute' => 'id_barang',
                        'value' => 'nama_barang',
                        'header' => 'Nama Barang',
                    ],
                    'jumlah',
                    'keterangan',
                ],
            ]);
            ?>
        </div>
    </div>

</div>
