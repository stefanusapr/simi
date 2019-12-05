<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
    </head>
    <body>
        <!-- Modal Tambah Vendor Baru -->
        <div class="modal fade" id="myModalVendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Vendor Baru</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/vendor/create" method="POST">
                            <div class="form-group">
                                <label for="nama-barang" class="control-label">Nama:</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="stok" class="control-label">No Hp:</label>
                                <input type="text" class="form-control" id="no_hp">
                            </div>
                            <div class="form-group">
                                <label for="merk" class="control-label">Email:</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="merk" class="control-label">Alamat:</label>
                                <input type="text" class="form-control" id="alamat">
                            </div>
                            <div class="form-group">
                                <label for="merk" class="control-label">Keterangan:</label>
                                <input type="text" class="form-control" id="keterangan">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="submit" value="Simpan" />
                    </div>
                </div>                
            </div>
        </div>
    </body>
</html>

