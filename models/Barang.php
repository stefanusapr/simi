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
            [['stok'], 'integer', 'min' => 0],
            [['nama', 'merk', 'jenis', 'kode_barang', 'keterangan'], 'string', 'max' => 255],
            [['kode_barang'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nama' => 'Nama Barang',
            'stok' => 'Stok',
            'merk' => 'Merk',
            'jenis' => 'Jenis',
            'kode_barang' => 'Kode',
            'keterangan' => 'Keterangan',
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

    public function getBarangAvailable() {
        return $query = Barang::find()
                ->where(['>', 'stok', '0'])
                ->all();
    }

    public function getCountStock() {
        $query = Barang::find()
                ->joinWith('transaksiMasukDetail')
                ->joinWith('transaksiKeluarDetail')
        ;
    }
}
