<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-view">

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
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> List Vendor'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-envelope"></span> Kirim'), ['email', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>
    <div class="table-responsive">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'nama',
                'alamat:ntext',
                'no_hp',
                'email:email',
                'keterangan:ntext',
            ],
        ])
        ?>
    </div>

    <div class="item panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-history"></i> Riwayat Kirim Pesan</h3>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">

            <div class="table-responsive">
                <?=
                GridView::widget([
                    'dataProvider' => $kirimPesan,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'judul',
                        [
                            'attribute' => 'isi_pesan',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'waktu_kirim',
                            'format' => ['date', 'php: d-m-Y H:i:s'],
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
