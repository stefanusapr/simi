<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-keluar-index">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Transaksi Keluar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
//        'responsive' => true,
//        'hover' => true,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'tgl_keluar',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'tgl_surat',
                'format' => ['date', 'php: d-m-Y'],
            ],
            'nama_penerima',
            [
                'attribute' => 'keterangan',
                'headerOptions' => ['style' => 'width:30%'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:100px, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat} &nbsp {edit} &nbsp {hapus}',
                'buttons' => [
                    'edit' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-info',]);
                    },
                    'lihat' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Lihat', ['view', 'id' => $model->id], ['class' => 'btn btn-success',]);
                    },
                    'hapus' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Anda yakin ingin menghapus?',
                                        'method' => 'post',
                                    ],
                        ]);
                    }
                ]
            ],
        ],
    ]);
    ?>


</div>
