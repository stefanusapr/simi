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
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        'dataProvider' => $dataProvider,
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
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:100px, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Lihat', ['view-waka', 'id' => $model->id], ['class' => 'btn btn-warning',]);
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
