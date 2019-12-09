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
                        <th>No</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal SPK</td>
                        <th>Nama Vendor</td>
                        <th>Nomor Faktur</th>
                        <th>Tanggal Faktur</th>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Tahun Pembuatan</th>
                        <th>Nomor Berita Acara Pemeriksaan</th>
                        <th>Tanggal Berita Acara Pemeriksaan</th>
                        <th>Nomor Bukti Penerimaan</th>
                        <th>Tanggal Bukti Penerimaan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php
                        for ($i = 0; $i < 17; $i++):
                            ?>
                            <td>
                                <?= $i + 1; ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                    <?php
                    $no = 0;
                    foreach ($modelDetails->models as $detail):
                        ?>
                        <tr>
                            <td><?= ++$no; ?></td>
                            <td><?= Yii::$app->formatter->asDate($detail->transaksiMasuk->tgl_masuk) ?></td>
                            <td><?= Yii::$app->formatter->asDate($detail->transaksiMasuk->tgl_spk) ?></td>
                            <td><?= $detail->transaksiMasuk->vendor->nama ?></td>
                            <td><?= $detail->transaksiMasuk->no_faktur ?></td>
                            <td><?= Yii::$app->formatter->asDate($detail->transaksiMasuk->tgl_faktur) ?></td>
                            <td><?= $detail->barang->nama ?></td>
                            <td><?= $detail->barang->merk ?></td>                
                            <td><?= $detail->jumlah ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($detail->harga_satuan) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($detail->jumlah * $detail->harga_satuan) ?></td>
                            <td><?= $detail->thn_produksi ?></td>
                            <td><?= $detail->transaksiMasuk->no_berita_acara ?></td>
                            <td><?= Yii::$app->formatter->asDate($detail->transaksiMasuk->tgl_berita_acara) ?></td>
                            <td><?= $detail->transaksiMasuk->no_pemeriksaan ?></td>
                            <td><?= Yii::$app->formatter->asDate($detail->transaksiMasuk->tgl_pemeriksaan) ?></td>
                            <td><?= $detail->keterangan ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>