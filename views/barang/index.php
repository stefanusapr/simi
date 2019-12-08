<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\CustomPagination;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <!-- <div class="col-md-4">
                    <p>
        <?php // Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['#'], ['class' => 'btn btn-primary']) ?>
                    </p>
                </div>-->
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
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'kode_barang',
            [
                'attribute' => 'nama',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute' => 'stok',
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                'attribute' => 'merk',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute' => 'jenis',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            //s ['class' => 'yii\grid\ActionColumn'],
//            [
//                'format' => 'raw',
//                'value' => function($data) {
//                    return
//                            Html::a('<span class="glyphicon glyphicon-eye-open"></span> Lihat', ['view', 'id' => $data->id], ['title' => 'view', 'class' => 'btn btn-success']) . ' ' .
//                            Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $data->id], ['title' => 'edit', 'class' => 'btn btn-primary']) . ' ' .
//                            Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $data->id], [
//                                'class' => 'btn btn-danger',
//                                'data' => [
//                                    'confirm' => 'Anda yakin ingin menghapus?',
//                                    'method' => 'post',
//                                ],
//                    ]);
//                }
//            ],
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
