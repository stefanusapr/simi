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
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> List Barang'), ['index-waka'], ['class' => 'btn btn-warning']) ?>
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