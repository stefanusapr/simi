<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

foreach ($dataProviderTM->models as $key => $j) {
    var_dump($key);
    var_dump($j->harga_satuan);
}
echo"<br><br>";
    var_dump($dataProviderTM->models);

exit;
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
                <p style="font-size:18px" class="text-center"><b><u>DETAIL MASTER BARANG</u></b></p>
                <br>
            </div>
        </div>

        <div class="box box-info" style="overflow-x: auto; padding: 15px;">
            <table>
                <tr>
                    <th>Nama Barang</th>
                    <td>:</td>
                    <td><?= $model->nama ?></td> 
                </tr>
                <tr>
                    <th>Kode Barang</th>
                    <td>:</td>
                    <td><?= $model->kode_barang ?></td> 
                </tr>
            </table>
            <br>
            <p style="font-size:14px" >Berikut ini merupakan rincian transaksi pada barang <b><?= $model->nama ?></b>: </p>
        </div>

        <div class="box box-info" style="overflow-x: auto; padding: 15px;">
            <table class="table table-bordered">
                <thead>
<!--                    <tr>
                        <th colspan="4"></th>
                        <th colspan="4"></th>
                        <th colspan="4"></th>
                    </tr>-->
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Pemasok</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>        
                        <th>Nama Penerima</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                    <?php
                    for ($i = 0; $i < 9; $i++):
                        ?>
                            <td>
                            <?= $i + 1; ?>
                            </td>
                            <?php endfor; ?>
                    </tr>
                        <?php
                        $no = 0;
                        foreach ($dataProviderTM->models as $detail):
                            ?>
                        <tr>
                            <td><?= ++$no; ?></td>
                            <td><?= $detail->transaksiMasuk->tgl_masuk ?></td>
                            <td><?= $detail->transaksiMasuk->vendor->nama ?></td>
                            <td><?= $detail->jumlah ?></td>
                            <td><?= $detail->keterangan ?></td>
                        
                        <?php endforeach ?> 
                        
                        <?php
                        foreach ($dataProviderTK->models as $detail):
                            ?>
                        
                            <td><?= $detail->transaksiKeluar->tgl_keluar ?></td>
                            <td><?= $detail->transaksiKeluar->nama_penerima ?></td>
                            <td><?= $detail->jumlah ?></td>
                            <td><?= $detail->keterangan ?></td> 
                        </tr>
                        <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>