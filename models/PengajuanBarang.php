<?php

namespace app\models;


use Yii;
use yii\db\Query;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "pengajuan_barang".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $id_pengajuan
 * @property int $jumlah
 * @property int $harga_satuan
 * @property int|null $status
 *
 * @property Barang $barang
 * @property Pengajuan $pengajuan
 */
class PengajuanBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    
    public static function tableName()
    {
        return 'pengajuan_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'id_pengajuan', 'jumlah', 'harga_satuan'], 'required'],
            [['id_barang', 'id_pengajuan', 'jumlah', 'harga_satuan', 'status'], 'integer'],
            [['keterangan'], 'string'],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['id_barang' => 'id']],
           // [['id_pengajuan'], 'exist', 'skipOnError' => true, 'targetClass' => Pengajuan::className(), 'targetAttribute' => ['id_pengajuan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'id_barang' => 'Nama Barang',
            'id_pengajuan' => 'Kode Pengajuan',
            'jumlah' => 'Jumlah (satuan)',
            'harga_satuan' => 'Harga Satuan',
            'status' => 'Status',
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
    public function getPengajuan()
    {
        return $this->hasOne(Pengajuan::className(), ['id' => 'id_pengajuan']);
    }
    
    public function getStatusLabel() {
        return $this->status ? 'Setuju pembelian' : 'Tunda pembelian';
    }
        
}
