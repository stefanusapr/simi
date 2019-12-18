<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_keluar".
 *
 * @property int $id
 * @property string $tgl_keluar
 * @property string|null $tgl_surat
 * @property string|null $nama_penerima
 *
 * @property TransaksiKeluarDetail[] $transaksiKeluarDetails
 */
class TransaksiKeluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_keluar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_keluar'], 'required'],
            [['tgl_keluar', 'tgl_surat'], 'safe'],
            [['keterangan'], 'string'],
            [['nama_penerima'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'tgl_keluar' => 'Tanggal Barang Keluar',
            'tgl_surat' => 'Tanggal SPK',
            'nama_penerima' => 'Nama Pemohon',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKeluarDetails()
    {
        return $this->hasMany(TransaksiKeluarDetail::className(), ['id_transaksi_keluar' => 'id']);
    }
}
