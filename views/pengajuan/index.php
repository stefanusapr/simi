<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengajuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-index">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Pengajuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'header' => 'Kode',
                'value' => function ($dataProvider) {
                    return 'TP-' . $dataProvider->id;
                }
            ],
            [
                'attribute' => 'tgl_pengajuan',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'status',
                'value' => 'StatusLabel',
                'header' => 'Status',
            ],
            [
                'label' => 'Barang',
                'value' => function($dataProvider) {
                    return join(', ', yii\helpers\ArrayHelper::map($dataProvider->pengajuanBarangs, 'id_barang', 'barang.nama'));
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:100px, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat} &nbsp {edit} &nbsp {hapus}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Lihat', ['view', 'id' => $model->id], ['class' => 'btn btn-success',]);
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>

