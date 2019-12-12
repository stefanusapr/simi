<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Keluar';
$this->params['breadcrumbs'][] = $this->title;

//var_dump($dataProvider);exit;

?>
<div class="transaksi-keluar-index">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Transaksi Keluar', ['create'], ['class' => 'btn btn-success']) ?>
        <?=
        Html::a('<span class="glyphicon glyphicon-print"></span> Cetak',
                ['report'], [
            'data-method' => 'POST',
            'data-params' => ['param1' => $dataProvider],
            'class' => 'btn btn-primary',
        ])
        ?>
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
//        'responsive' => true,
//        'hover' => true,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'header' => 'Kode',
                'headerOptions' => ['style' => 'width:10%'],
                'value' => function ($dataProvider) {
                    return 'TK-' . $dataProvider->id;
                }
            ],
            [
                'attribute' => 'tgl_keluar',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'tgl_surat',
                'format' => ['date', 'php: d-m-Y'],
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute' => 'nama_penerima',
                'headerOptions' => ['style' => 'width:15%'],
            ],
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
