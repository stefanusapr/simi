<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiKeluarDetail;

/**
 * TransaksiKeluarSearch represents the model behind the search form of `app\models\TransaksiKeluar`.
 */
class TransaksiKeluarDetailSearch extends TransaksiKeluarDetail {

    public $cari;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'id_barang', 'id_transaksi_keluar'], 'integer'],
            [['keterangan', 'jumlah', 'tgl_kembali', 'cari'], 'safe'],
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
    public function searchPeminjaman($params) {

        $query = TransaksiKeluarDetail::find()
                ->joinWith('barang')
                ->where(['barang.jenis' => 'Tidak Habis Pakai'])
                ->andWhere(['tgl_kembali' => null])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['transaksiKeluar.nama_penerima'] = [
            'asc' => ['transaksiKeluar.nama_penerima' => SORT_ASC],
            'desc' => ['transaksiKeluar.nama_penerima' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['transaksiKeluar.tgl_keluar'] = [
            'asc' => ['transaksiKeluar.tgl_keluar' => SORT_ASC],
            'desc' => ['transaksiKeluar.tgl_keluar' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['barang.nama'] = [
            'asc' => ['barang.nama' => SORT_ASC],
            'desc' => ['barang.nama' => SORT_DESC],
        ];

        $query->joinWith(['transaksiKeluar']);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_barang' => $this->id_barang,
            'id_transaksi_keluar' => $this->id_transaksi_keluar,
            'jumlah' => $this->jumlah,
            'tgl_kembali' => $this->tgl_kembali,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'keterangan', $this->cari])
                ->orFilterWhere(['like', 'transaksiKeluar.nama_penerima', $this->cari]);

        return $dataProvider;
    }

    public function searchRiwayatPeminjaman($params) {

        $query = TransaksiKeluarDetail::find()
                ->joinWith('barang')
                ->where(['barang.jenis' => 'Tidak Habis Pakai'])
                ->andWhere(['not', ['tgl_kembali' => null]])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['barang.nama'] = [
            'asc' => ['barang.nama' => SORT_ASC],
            'desc' => ['barang.nama' => SORT_DESC],
        ];

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
            'id_transaksi_keluar' => $this->id_transaksi_keluar,
            'jumlah' => $this->jumlah,
            'tgl_kembali' => $this->tgl_kembali,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'keterangan', $this->cari])
                ->orFilterWhere(['like', 'barang.nama', $this->cari]);

        return $dataProvider;
    }

    public function search($params) {
        $query = TransaksiKeluarDetail::find();

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
            'id_transaksi_keluar' => $this->id_transaksi_keluar,
            'jumlah' => $this->jumlah,
            'tgl_kembali' => $this->tgl_kembali,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'keterangan', $this->cari]);

        return $dataProvider;
    }

}
