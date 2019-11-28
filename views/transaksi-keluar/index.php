<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-keluar-index">
    <p>
        <?= Html::a('Tambah Transaksi Keluar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'tgl_keluar',
            'tgl_surat',
            'nama_penerima',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
