<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiKeluarDetail;
use kartik\daterange\DateRangeBehavior;

/**
 * TransaksiKeluarSearch represents the model behind the search form of `app\models\TransaksiKeluar`.
 */
class TransaksiKeluarDetailSearch extends TransaksiKeluarDetail {

    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;
    public $cari;

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'id_barang', 'id_transaksi_keluar'], 'integer'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
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

        $query->joinWith(['transaksiKeluar']);

        // add conditions that should always apply here
        $this->createTimeStart = strtotime($this->createTimeStart);
        $this->createTimeEnd = strtotime(date('Y-m-d'));


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['barang.nama'] = [
            'asc' => ['barang.nama' => SORT_ASC],
            'desc' => ['barang.nama' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['transaksiKeluar.nama_penerima'] = [
            'asc' => ['transaksi_keluar.nama_penerima' => SORT_ASC],
            'desc' => ['transaksi_keluar.nama_penerima' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['transaksiKeluar.tgl_keluar'] = [
            'asc' => ['transaksi_keluar.tgl_keluar' => SORT_ASC],
            'desc' => ['transaksi_keluar.tgl_keluar' => SORT_DESC],
        ];

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

        $query->andFilterWhere(['like', 'transaksi_keluar.nama_penerima', $this->cari])
                ->orFilterWhere(['like', 'barang.nama', $this->cari]);

        $query->andFilterWhere(['>=', 'transaksi_keluar.tgl_keluar', date('Y-m-d', ($this->createTimeStart))])
                ->andFilterWhere(['<=', 'transaksi_keluar.tgl_keluar', date('Y-m-d', ($this->createTimeEnd))]);

        return $dataProvider;
    }

    public function searchRiwayatPeminjaman($params) {

        $query = TransaksiKeluarDetail::find()
                ->joinWith('barang')
                ->andWhere(['not', ['tgl_kembali' => null]])
        ;

        $query->joinWith(['transaksiKeluar']);

        // add conditions that should always apply here
        $this->createTimeStart = strtotime($this->createTimeStart);
        $this->createTimeEnd = strtotime(date('Y-m-d'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['transaksiKeluar.nama_penerima'] = [
            'asc' => ['nama_penerima' => SORT_ASC],
            'desc' => ['nama_penerima' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['transaksiKeluar.tgl_keluar'] = [
            'asc' => ['transaksi_keluar.tgl_keluar' => SORT_ASC],
            'desc' => ['transaksi_keluar.tgl_keluar' => SORT_DESC],
        ];

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

        $query->andFilterWhere(['like', 'transaksi_keluar.nama_penerima', $this->cari])
                ->orFilterWhere(['like', 'barang.nama', $this->cari]);

        $query->andFilterWhere(['>=', 'tgl_kembali', date('Y-m-d', ($this->createTimeStart))])
                ->andFilterWhere(['<=', 'tgl_kembali', date('Y-m-d', ($this->createTimeEnd))]);

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
