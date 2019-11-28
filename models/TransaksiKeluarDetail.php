<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_keluar_detail".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $id_transaksi_keluar
 * @property int $jumlah
 * @property string|null $keterangan
 *
 * @property Barang $barang
 * @property TransaksiKeluar $transaksiKeluar
 */
class TransaksiKeluarDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_keluar_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'id_transaksi_keluar', 'jumlah'], 'required'],
            [['id_barang', 'id_transaksi_keluar', 'jumlah'], 'integer'],
            [['keterangan'], 'string'],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['id_barang' => 'id']],
           // [['id_transaksi_keluar'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiKeluar::className(), 'targetAttribute' => ['id_transaksi_keluar' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'id_barang' => 'Kode Barang',
            'id_transaksi_keluar' => 'Kode Transaksi Keluar',
            'jumlah' => 'Jumlah',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKeluar()
    {
        return $this->hasOne(TransaksiKeluar::className(), ['id' => 'id_transaksi_keluar']);
    }
}
