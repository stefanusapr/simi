<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajuan;

/**
 * PengajuanSearch represents the model behind the search form of `app\models\Pengajuan`.
 */
class PengajuanSearch extends Pengajuan {

    public $cari;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'status'], 'integer'],
            [['tgl_pengajuan', 'tgl_spk', 'tgl_persetujuan', 'keterangan', 'cari'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Pengajuan::find()
                ->where(['status' => null]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'tgl_spk' => $this->tgl_spk,
            'status' => $this->status,
            'tgl_persetujuan' => $this->tgl_persetujuan,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'keterangan', $this->cari]);

        return $dataProvider;
    }

    public function searchRiwayat($params) {

        $query = Pengajuan::find()
                ->where(['status' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'tgl_spk' => $this->tgl_spk,
            'status' => $this->status,
            'tgl_persetujuan' => $this->tgl_persetujuan,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'keterangan', $this->cari]);

        return $dataProvider;
    }
  }
