<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_masuk_detail".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $id_transaksi_masuk
 * @property string|null $thn_produksi
 * @property int $jumlah
 * @property string|null $keterangan
 *
 * @property Barang $barang
 * @property TransaksiMasuk $transaksiMasuk
 */
class TransaksiMasukDetail extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'transaksi_masuk_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_barang', 'id_transaksi_masuk', 'jumlah'], 'required'],
            [['id_barang', 'id_transaksi_masuk', 'jumlah', 'harga_satuan'], 'integer'],
            [['keterangan'], 'string'],
            [['thn_produksi'], 'integer'],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['id_barang' => 'id']],
//            [['id_transaksi_masuk'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiMasuk::className(), 'targetAttribute' => ['id_transaksi_masuk' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'Kode',
            'id_barang' => 'Nama Barang',
            'id_transaksi_masuk' => 'Kode Transaksi Masuk',
            'thn_produksi' => 'Tahun Produksi',
            'jumlah' => 'Jumlah (satuan)',
            'harga_satuan' => 'Harga Satuan',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang() {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiMasuk() {
        return $this->hasOne(TransaksiMasuk::className(), ['id' => 'id_transaksi_masuk']);
    }

}
