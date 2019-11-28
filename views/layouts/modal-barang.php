<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <!-- modal tambah barang baru-->
        <div class="modal fade" id="myModalBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Barang Baru</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nama-barang" class="control-label">Nama Barang:</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="stok" class="control-label">Stok:</label>
                                <input type="text" class="form-control" id="stok">
                            </div>
                            <div class="form-group">
                                <label for="merk" class="control-label">Merk:</label>
                                <input type="text" class="form-control" id="merk">
                            </div>
                            <div class="form-group">
                                <label for="stok" class="control-label">Jenis Barang:</label>
                                <div class="dropdown">
                                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Jenis Barang
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    </ul>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        
    </body>
</html>


