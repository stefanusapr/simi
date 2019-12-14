<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashborad">


    <div class="alert alert-info alert-dismissible fade in">
        <div> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h5><span class="fas fa-info-circle "></span>  Informasi</h4>
        </div>
        <strong>Info!</strong> This alert box could indicate a neutral informative change or action.
    </div>


    <div class="item panel panel-info">
        <div class="panel-body">
            <div class="container">
                <div class="jumbotron">
                    <h1>Selamat Datang</h1>
                    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing
                        responsive, mobile-first projects on the web.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $countBarang ?></h3>

                        <p>Data Barang</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['barang/index'], ['class' => 'small-box-footer']) ?>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $countTM ?></h3>

                        <p>Transaksi Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['transaksi-masuk/index'], ['class' => 'small-box-footer']) ?>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $countTK ?></h3>

                        <p>Transaksi Keluar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['transaksi-keluar/index'], ['class' => 'small-box-footer']) ?>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $countTM ?></h3>

                        <p>Transaksi Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['create'], ['class' => 'small-box-footer']) ?>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

</div>


