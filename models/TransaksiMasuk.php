<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_masuk".
 *
 * @property int $id
 * @property string|null $tgl_spk
 * @property string $tgl_masuk
 * @property int $id_vendor
 * @property string|null $no_faktur
 * @property string|null $tgl_faktur
 * @property string|null $no_berita_acara
 * @property string|null $tgl_berita_acara
 * @property string|null $no_pemeriksaan
 * @property string|null $tgl_pemeriksaan
 *
 * @property Vendor $vendor
 * @property TransaksiMasukDetail[] $transaksiMasukDetails
 */
class TransaksiMasuk extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'transaksi_masuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tgl_spk', 'tgl_masuk', 'tgl_faktur', 'tgl_berita_acara', 'tgl_pemeriksaan'], 'safe'],
            [['tgl_masuk', 'id_vendor'], 'required'],
            [['id_vendor'], 'integer'],
            [['no_faktur', 'no_berita_acara', 'no_pemeriksaan'], 'string', 'max' => 255],
            [['id_vendor'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['id_vendor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'Kode',
            'tgl_spk' => 'Tanggal SPK',
            'tgl_masuk' => 'Tanggal Masuk',
            'id_vendor' => 'Nama Vendor',
            'no_faktur' => 'No Faktur',
            'tgl_faktur' => 'Tanggal Faktur',
            'no_berita_acara' => 'No Berita Acara',
            'tgl_berita_acara' => 'Tanggal Berita Acara',
            'no_pemeriksaan' => 'No Pemeriksaan',
            'tgl_pemeriksaan' => 'Tanggal Pemeriksaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor() {
        return $this->hasOne(Vendor::className(), ['id' => 'id_vendor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiMasukDetails() {
        return $this->hasMany(TransaksiMasukDetail::className(), ['id_transaksi_masuk' => 'id']);
    }

}
