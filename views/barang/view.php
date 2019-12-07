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
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> List Barang'), ['index'], ['class' => 'btn btn-warning']) ?>
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
            'keterangan',
        ],
    ])
    ?>

</div>