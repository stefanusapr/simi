<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="pdf-report container">
    <div class="row">
        <div id="header-report" class="col-md-12">
            <table style="width: 100%;">
                <tr>
                    <td width="100px">
                        <img src= "<?= Url::to('@web/img/logo_sma.png'); ?>" style="width: 65px; height:auto;">
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
                <p style="font-size:18px" class="text-center"><b><u>PEMBELIAN BARANG SARANA DAN PRASARANA</u></b></p>
                <br>
            </div>
        </div>

        <div class="box box-info" style="overflow-x: auto; padding: 15px;">
            <table>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <td>:</td>
                    <td><?= Yii::$app->formatter->asDate($pengajuan->tgl_pengajuan) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Persetujuan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <td>:</td>
                    <td><?= Yii::$app->formatter->asDate($pengajuan->tgl_persetujuan) ?></td>
                </tr>
                <tr>
                    <th>Tanggal SPK</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <td>:</td>
                    <td><?= Yii::$app->formatter->asDate($pengajuan->tgl_spk) ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <th></th>
                    <th></th><th></th>
                    <td>:</td>
                    <td><?= $pengajuan->keterangan ?></td>
                </tr>
            </table>
            <br>
            <p style="font-size:14px" >Berikut ini merupakan rincian pembelian barang yang telah disetujui:</p>
        </div>

        <div class="box box-info" style="overflow-x: auto; padding: 15px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>                
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($details->models as $detail):
                        ?>
                        <tr>
                            <td><?= ++$no; ?></td>
                            <td><?= $detail->barang->nama ?></td>                
                            <td><?= $detail->jumlah ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($detail->harga_satuan) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($detail->jumlah * $detail->harga_satuan) ?></td>
                            <td><?= $detail->keterangan ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <p style="font-size:14px" >Demikian pengajuan pembelian barang sarana dan prasarana terima kasih.</p>
            <br>

            <div class="col-md-12">
                <p>&nbsp;</p>
                <table style="font-size:14px" width="100%">
                    <tr><td></td><td>
                            Malang, 
                        </td></tr>
                    <tr>
                        <td width="65%">Wakil Kepala Sekolah <br> Sarana dan Prasarana<br/><br/><br/><br/><br/>Drs. Abd. Rahman<br>NIP. 19660307 200312 1 002</td>
                        <td width="35%">Petugas <br> Sarana dan Prasarana<br/><br/><br/><br/><br/>Deny Prasojo<br>NIP. ____________________</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>