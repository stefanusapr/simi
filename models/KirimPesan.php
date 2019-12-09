<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kirim_pesan".
 *
 * @property int $id
 * @property int $id_vendor
 * @property string $judul
 * @property string|null $isi_pesan
 * @property string|null $waktu_kirim
 *
 * @property Vendor $vendor
 */
class KirimPesan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kirim_pesan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_vendor', 'judul'], 'required'],
            [['id_vendor'], 'integer'],
            [['judul', 'isi_pesan'], 'string'],
            [['waktu_kirim'], 'safe'],
            [['id_vendor'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['id_vendor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_vendor' => 'Nama Vendor',
            'judul' => 'Judul Pesan',
            'isi_pesan' => 'Isi Pesan',
            'waktu_kirim' => 'Waktu Mengirim Pesan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'id_vendor']);
    }
}
