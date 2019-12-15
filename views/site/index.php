<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashborad">

    <?php if (!Yii::$app->user->isGuest): ?>
        <?php if (Yii::$app->user->identity->AuthKey == 'test101key'): ?>
            <div class="dashboard">       
                <div class="alert alert-info alert-dismissible fade in">
                    <div> 
                        <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                        <h5><span class="fas fa-info-circle "></span> <strong> Informasi</strong></h4>
                    </div>                   
                    <p>
                        Anda telah menerima <?= $countPengajuan ?> pengajuan pembelian barang, harap segera diperiksa.
                    </p>
                </div>

                <div class="item panel panel-info">
                    <div class="container">
                        <h3>Selamat Datang</h3>
                        <p>
                            Sistem Informasi Manajemen Inventaris Barang Sarana dan Prasarana SMAN 2 Malang
                            <br>
                            Memfasilitasi untuk membantu dalam pengelolan barang sarpras:
                        </p>
                        <ul>
                            <li>Daftar master barang</li>
                            <li>Daftar pengajuan</li>
                            <li>Memberika persetujuan</li>                            
                        </ul>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3><?= $countBarang ?></h3>

                                    <p>Data Barang</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['barang/index-waka'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?= $countPengajuan ?></h3>

                                    <p>Data Pengajuan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['persetujuan/index'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $countPersetujuan ?></h3>

                                    <p>Data Persetujuan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['persetujuan/index-persetujuan'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>Pengguna</h3>

                                    <p>Pengaturan Akun</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['site/akun'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->  
                    </div>
                    <!-- /.row -->
            </div>

        <?php endif ?>
        <?php if (Yii::$app->user->identity->AuthKey == 'test100key'): ?>
            <div class="dashboard">       
                <div class="alert alert-info alert-dismissible fade in">
                    <div> 
                        <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                        <h5><span class="fas fa-info-circle "></span> <strong> Informasi</strong></h4>
                    </div>                   
                    <p>
                        Anda telah menerima <?= $countPersetujuan ?> persetujuan
                    </p>
                </div>

                <div class="item panel panel-info">
                    <div class="container">
                        <h3>Selamat Datang</h3>
                        <p>
                            Sistem Informasi Manajemen Inventaris Barang Sarana dan Prasarana SMAN 2 Malang
                            <br>
                            Memfasilitasi untuk membantu dalam pengelolan barang sarpras:
                        </p>
                        <ul>
                            <li>Mencatat master barang</li>
                            <li>Mengajukan pembelian barang</li>
                            <li>Mencatat transaksi barang masuk dan keluar</li>                            
                            <li>Mencatat data vendor dan mengirim pesan</li>                                                        
                            <li>Mencetak laporan</li>
                        </ul>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?= $countPinjam ?></h3>
                                    <p>Peminjaman Barang</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['peminjaman/index'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box  bg-purple-active">
                                <div class="inner">
                                    <h3><?= $countVendor ?></h3>

                                    <p>Data Vendor</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['vendor/index'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-blue-active">
                                <div class="inner">
                                    <h3><?= $countPengajuan ?></h3>

                                    <p>Data Pengajuan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['pengajuan/index'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-light-blue-active">
                                <div class="inner">
                                    <h3><?= $countPersetujuan ?></h3>

                                    <p>Data Persetujuan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['pengajuan/index-persetujuan'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-fuchsia">
                                <div class="inner">
                                    <h3>Pengguna</h3>

                                    <p>Pengaturan Akun</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <?= Html::a('Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i>', ['site/akun'], ['class' => 'small-box-footer']) ?>
                            </div>
                        </div>
                        <!-- ./col -->                        
                    </div>
                    <!-- ./row -->  
            </div>
        <?php endif ?>
    <?php endif ?>
</div>


