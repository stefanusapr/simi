<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $id
 * @property string $nama
 * @property int $stok
 * @property string $merk
 * @property string $jenis
 * @property string $kode_barang
 *
 * @property PengajuanBarang[] $pengajuanBarangs
 * @property TransaksiKeluarDetail[] $transaksiKeluarDetails
 * @property TransaksiMasukDetail[] $transaksiMasukDetails
 */
class Barang extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nama', 'merk', 'jenis', 'kode_barang'], 'required'],
            [['stok'], 'integer'],
            [['nama', 'merk', 'jenis', 'kode_barang'], 'string', 'max' => 255],
            [['kode_barang'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'stok' => 'Stok',
            'merk' => 'Merk',
            'jenis' => 'Jenis Barang',
            'kode_barang' => 'Kode Barang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanBarangs() {
        return $this->hasMany(PengajuanBarang::className(), ['id_barang' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKeluarDetails() {
        return $this->hasMany(TransaksiKeluarDetail::className(), ['id_barang' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiMasukDetails() {
        return $this->hasMany(TransaksiMasukDetail::className(), ['id_barang' => 'id']);
    }

    public function hitungBarang() {
        //query kartu stok master barang
        $sql_list = " SELECT t.id AS id_transaksi_masuk, "
                . "tanggal AS tgl_masuk, "
                . "d.id_detail AS id, "
                . "d.barang AS id_barang, "
                . "b.id AS id, "
                . "b.nama AS nama, "
                . "b.kode AS kode_barang, "
                . "CASE "
                . "WHEN ";

        // query kartu stok
        $sql_list = "
        SELECT t.id AS trans_id
        , t.trans_code AS trans_code
        , t.trans_date AS trans_date
        , a.id AS detail_id, a.item_id AS item_id
        , trim(concat(t.remarks,' - ',a.remarks)) AS remarks
        , b.code AS item_code, b.name AS item_name
        , CASE 
            WHEN t.type_id=1 THEN a.quantity 
            WHEN t.type_id=2 THEN -a.quantity 
            ELSE 0 END
          AS quantity
        , @sal := @sal + CASE 
            WHEN t.type_id=1 THEN a.quantity 
            WHEN t.type_id=2 THEN -a.quantity 
            ELSE 0 END
          AS saldo
        FROM transactions t
        JOIN transaction_details a ON t.id = a.trans_id
        JOIN items b ON a.item_id = b.id
        JOIN ( SELECT @sal:=0 ) v
        WHERE b.id = :id
       ";
    }

}
