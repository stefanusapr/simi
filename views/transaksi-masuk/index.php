<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-masuk-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Tambah Transaksi Masuk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //  'id',
            'tgl_spk',
            'tgl_masuk',
            [
                'label' => 'Nama Vendor',
                'attribute' => 'vendor.nama',
            ],
            // 'no_faktur',
            //'tgl_faktur',
            //'no_berita_acara',
            //'tgl_berita_acara',
            //'no_pemeriksaan',
            //'tgl_pemeriksaan',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
