<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-index">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Vendor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="pull-left col-md-3">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
<!--        <p class="pull-right col-md-3">
        <?php //echo  Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['#'], ['class' => 'btn btn-info']) ?>
        </p>-->
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'nama',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute' => 'alamat',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute' => 'no_hp',
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                'attribute' => 'email',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute' => 'keterangan',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:20%, align:center;'],
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
