<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-masuk-index">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Transaksi Masuk', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['report'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //  'id',
            [
                'header' => 'Kode',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($dataProvider) {
                    return 'TM-' . $dataProvider->id;
                }
            ],
            [
                'attribute' => 'tgl_masuk',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'tgl_spk',
                'format' => ['date', 'php: d-m-Y'],
            ],
            'vendor.nama',
            'no_faktur',
            [
                'attribute' => 'tgl_faktur',
                'format' => ['date', 'php: d-m-Y'],
            ],
            //'no_berita_acara',
            //  'tgl_berita_acara',
            // 'no_pemeriksaan',
            //'tgl_pemeriksaan',
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:100px, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat} &nbsp {edit} &nbsp {hapus}',
                'buttons' => [
                    'edit' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary',]);
                    },
                    'lihat' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Lihat', ['view', 'id' => $model->id], ['class' => 'btn btn-success',]);
                    },
//                    'hapus' => function($url, $model, $key) {
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
//                                    'class' => 'btn btn-danger',
//                                    'data' => [
//                                        'confirm' => 'Anda yakin ingin menghapus?',
//                                        'method' => 'post',
//                                    ],
//                        ]);
//                    }
                ]
            ],
        ],
    ]);
    ?>
</div>

