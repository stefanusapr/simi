<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajuan;
use app\models\PengajuanBarang;
use app\models\PengajuanSearch;

/**
 * PengajuanBarangSearch represents the model behind the search form of `app\models\PengajuanBarang`.
 */
class PengajuanBarangSearch extends PengajuanBarang {

    public $cari;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'id_barang', 'id_pengajuan', 'jumlah', 'harga_satuan', 'status'], 'integer'],
            [['jumlah', 'harga_satuan', 'keterangan', 'cari'], 'safe'],
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
        $query = PengajuanBarang::find();
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
            'id_barang' => $this->id_barang,
            'id_pengajuan' => $this->id_pengajuan,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }

    public function searchRiwayat($params) {
        $query = PengajuanBarang::find()
                ->where(['status' => true])
                ->orWhere(['status' => false]);

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
            'id_barang' => $this->id_barang,
            'id_pengajuan' => $this->id_pengajuan,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }

}
