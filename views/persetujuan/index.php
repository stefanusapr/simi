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

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Tambah Pengajuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tgl_pengajuan',
            'tgl_spk',
            'setuju',
            'tgl_persetujuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
