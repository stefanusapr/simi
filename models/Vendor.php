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
            [['nama', 'no_hp', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
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
