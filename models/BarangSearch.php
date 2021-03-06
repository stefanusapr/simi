<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Barang;

/**
 * BarangSearch represents the model behind the search form of `app\models\Barang`.
 */
class BarangSearch extends Barang {

    public $cari;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'stok'], 'integer'],
            [['nama', 'merk', 'jenis', 'kode_barang', 'keterangan', 'cari'], 'safe'],
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
        $query = Barang::find();

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
            'stok' => $this->stok,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'merk', $this->merk])
                ->andFilterWhere(['like', 'jenis', $this->jenis])
                ->andFilterWhere(['like', 'kode_barang', $this->kode_barang])
                ->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'nama', $this->cari])
                ->orFilterWhere(['like', 'merk', $this->cari])
                ->orFilterWhere(['like', 'jenis', $this->cari])
                ->orFilterWhere(['like', 'kode_barang', $this->cari])
                ->orFilterWhere(['like', 'keterangan', $this->cari]);
        ;

        return $dataProvider;
    }
    
    
    public function searchTMByID($params, $id_ = null) {
        $query = TransaksiMasukDetail::find()
                ->joinWith(['transaksiMasuk'])
                ->where(['id_barang'=>$id_])
                ->orderBy(['transaksi_masuk.tgl_masuk' => SORT_DESC])
                ;

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

        return $dataProvider;
    }
    
    public function searchTKByID($params, $id_ = null) {
        $query = TransaksiKeluarDetail::find()
                ->joinWith(['transaksiKeluar'])
                ->where(['id_barang'=>$id_])
                ->orderBy(['transaksi_keluar.tgl_keluar' => SORT_DESC])
                ;

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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'stok' => $this->stok,
//        ]);
//
//        $query->andFilterWhere(['like', 'nama', $this->nama])
//                ->andFilterWhere(['like', 'merk', $this->merk])
//                ->andFilterWhere(['like', 'jenis', $this->jenis])
//                ->andFilterWhere(['like', 'kode_barang', $this->kode_barang])
//                ->andFilterWhere(['like', 'keterangan', $this->keterangan])
//                ->orFilterWhere(['like', 'nama', $this->cari])
//                ->orFilterWhere(['like', 'merk', $this->cari])
//                ->orFilterWhere(['like', 'jenis', $this->cari])
//                ->orFilterWhere(['like', 'kode_barang', $this->cari])
//                ->orFilterWhere(['like', 'keterangan', $this->cari]);
//        ;

        return $dataProvider;
    }

}
