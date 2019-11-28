<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiKeluarDetail;

/**
 * TransaksiKeluarSearch represents the model behind the search form of `app\models\TransaksiKeluar`.
 */
class TransaksiKeluarDetailSearch extends TransaksiKeluarDetail {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'id_barang', 'id_transaksi_keluar'], 'integer'],
            [['keterangan', 'jumlah',], 'safe'],
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
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }

}
