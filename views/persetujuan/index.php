<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pengajuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-index">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'tgl_pengajuan',
                'format' => ['date', 'php: d-m-Y'],
            ],
            [
                'attribute' => 'status',
                'value' => 'StatusLabel',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'widget:100px, align:center;'],
                'header' => 'Tindakan',
                'template' => '{lihat} &nbsp {edit} &nbsp {hapus}',
                'buttons' => [
                    'edit' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-info',]);
                    },
                ]
            ],
        ],
    ]);
    ?>


</div>
