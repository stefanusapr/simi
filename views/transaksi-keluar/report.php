<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

//foreach ($modelDetails->models as $detail) {
//    var_dump($detail->tgl_keluar);
//    foreach ($detail->transaksiKeluarDetails as $j) {
//        var_dump($j->transaksiKeluar->tgl_keluar);
//    }
//    echo "<br>";
//}
//exit;
?>

<div class="pdf-report container">
    <div class="row">
        <div id="header-report" class="col-md-12">
            <table style="width: 100%;">
                <tr>
                    <td width="100px">
                        <img src= "<?= Url::to('@web/img/logo_sma.png'); ?>" style="width: 75px; height:auto;">
                    </td>
                    <td>
                <center>
                    <h4 style="margin: 0px; font-family:Arial;font-size:12pt;color:#000">Kementerian Pendidikan dan Kebudayaan Republik Indonesia</h4>
                    <h5 style="margin: 0px;font-family:Arial;font-size:12pt;">SMA NEGERI 2 MALANG<br/></h5>
                    <div style="width:90%">
                        <h6 style="margin: 0px; font-size:9pt;font-family:Arial;">Jl. Laksamana Martadinata No.84, Sukoharjo, Kec. Klojen, Kota Malang, Jawa Timur 65118</h6>
                        <h6 style="margin: 0px; font-size:9pt;font-family:Arial;">Telp.: +62 (0341) 366311</h6>
                        <h6 style="margin: 0px; font-size:9pt;font-family:Arial;">https://www.sman2-malang.sch.id &nbsp; &nbsp;E-mail : humas@sman2-malang.sch.id</h6>
                    </div>
                </center>	
                </td>
                </tr>
            </table>
            <hr style="margin:0px;color:#000;border-style:solid none none;border-width:4px 0 0;"/><br>
        </div>
    </div>

    <div class="box box-info" style="overflow-x: auto;">
        <div class="row">
            <div class="col-md-12">
                <p style="font-size:18px" class="text-center"><b><u>LAPORAN PENGELUARAN BARANG SARANA DAN PRASARANA</u></b></p>
                <br>
            </div>
        </div>

        <div class="box box-info" style="overflow-x: auto; padding: 15px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Keluar</th>
                        <th>Tanggal SPK</th>
                        <th>Nama Penerima</th>
                        <th>Barang</th>
                        <th>Merk</th>
                        <th>Jumlah</th>             
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php
                        for ($i = 0; $i < 8; $i++):
                            ?>
                            <td>
                                <?= $i + 1; ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                    <?php
                    $no = 0;
                    foreach ($modelDetails->models as $detail):
                        foreach ($detail->transaksiKeluarDetails as $detailTKD):
                            ?>
                            <tr>
                                <td><?= ++$no; ?></td>
                                <td><?= Yii::$app->formatter->asDate($detailTKD->transaksiKeluar->tgl_keluar) ?></td>
                                <td><?= Yii::$app->formatter->asDate($detailTKD->transaksiKeluar->tgl_surat) ?></td>
                                <td><?= $detailTKD->transaksiKeluar->nama_penerima ?></td>
                                <td><?= $detailTKD->barang->nama ?></td>
                                <td><?= $detailTKD->barang->merk ?></td>                 
                                <td><?= $detailTKD->jumlah ?></td>
                                <td><?= $detailTKD->keterangan ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>