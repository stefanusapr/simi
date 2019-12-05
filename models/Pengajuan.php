<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengajuan".
 *
 * @property int $id
 * @property string|null $tgl_pengajuan
 * @property string|null $tgl_spk
 * @property int|null $setuju
 * @property string|null $tgl_persetujuan
 *
 * @property PengajuanBarang[] $pengajuanBarangs
 */
class Pengajuan extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pengajuan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tgl_pengajuan', 'tgl_spk', 'tgl_persetujuan'], 'safe'],
            [['status'], 'integer'],
            [['keterangan'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'Kode',
            'tgl_pengajuan' => 'Tanggal Pengajuan',
            'tgl_spk' => 'Tanggal SPK',
            'status' => 'Status',
            'tgl_persetujuan' => 'Tanggal Persetujuan',
            'keterangan' => 'Catatan'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanBarangs() {
        return $this->hasMany(PengajuanBarang::className(), ['id_pengajuan' => 'id']);
    }

    public function getStatusLabel() {
        return $this->status ? 'Selesai diperiksa' : 'Menunggu diperiksa';
    }

}
