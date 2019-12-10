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
        <?php //echo  Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['#'], ['class' => 'btn btn-primary']) ?>
        </p>-->
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
        //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nama',
            'alamat',
            'no_hp',
            'email',
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:20%, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat} &nbsp {edit} &nbsp {hapus} &nbsp {kirim}',
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
//                    },
                    'kirim' => function($url, $model, $key) {
                        if ($model->email) {
                            return Html::a('<span class="glyphicon glyphicon-envelope"></span> Kirim', ['email', 'id' => $model->id], ['class' => 'btn btn-info']);
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-envelope"></span> Kirim', ['email', 'id' => $model->id], ['class' => 'btn btn-info active disabled']);
                        }
                    },
                ]
            ],
        ],
    ]);
    ?>
</div>
