<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kidzen\dynamicform\DynamicFormWidget;

use app\models\TransaksiMasuk;
use app\models\TransaksiMasukDetail;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('app', 'List Barang'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'kode_barang',
            'nama',
            'stok',
            'merk',
            'jenis',
        ],
    ])
    ?>

    <h3> Detail </h3>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'column' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tgl_masuk',
            'kode_barang',
            'nama',
            'stok',
            'jumlah',
            'total',
            'keterangan'
        ],
    ]);
    ?>

</div>
