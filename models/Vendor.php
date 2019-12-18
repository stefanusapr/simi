<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property string $nama
 * @property string|null $alamat
 * @property string $no_hp
 * @property string|null $email
 * @property string|null $keterangan
 *
 * @property TransaksiMasuk[] $transaksiMasuks
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['alamat', 'keterangan'], 'string'],
            [['nama', 'email'], 'string', 'max' => 255],
            [['no_hp'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'nama' => 'Nama Vendor',
            'alamat' => 'Alamat',
            'no_hp' => 'No Telepon',
            'email' => 'Email',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiMasuks()
    {
        return $this->hasMany(TransaksiMasuk::className(), ['id_vendor' => 'id']);
    }
}
