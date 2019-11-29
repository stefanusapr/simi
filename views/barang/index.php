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

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Tambah Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'kode_barang',
            'nama',
            'stok',
            'merk',
            'jenis',          

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
<!--    <div id="custom-pagination">
        <?php
       // echo CustomPagination::widget([
           // 'pagination' => $pages,
       // ]);
        ?>
    </div>-->


</div>
