<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kidzen\dynamicform\DynamicFormWidget;
use app\models\TransaksiMasuk;
use app\models\TransaksiMasukDetail;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah', ['create'], ['class' => 'btn btn-success']) ?>
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
            <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-barcode"></i> Detail Transaksi</h3>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">

            <div class="table-responsive">
                <?=
                GridView::widget([
                    // 'dataProvider' => $modelDetail,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'tgl_masuk',
                            'value' => 'transaksiMasuk.tgl_masuk', 
                            'format' => ['date', 'php: d-m-Y'],
                        ],
                        [
                            'attribute' => 'id_barang',
                            'value' => 'barang.nama',
                            'header' => 'Nama Barang',
                        ],
                        [
                            'attribute' => 'id_barang',
                            'value' => 'barang.jenis',
                            'header' => 'Jenis Barang',
                        ],
                        'jumlah',
                        [
                            'attribute' => 'tgl_kembali',
                            'format' => ['date', 'php: d-m-Y'],
                        ],
                        'keterangan',
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>

</div>