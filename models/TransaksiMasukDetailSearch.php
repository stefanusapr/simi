<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiMasukDetail;

/**
 * TransaksiMasukSearch represents the model behind the search form of `app\models\TransaksiMasuk`.
 */
class TransaksiMasukDetailSearch extends TransaksiMasukDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_barang','id_transaksi_masuk'], 'integer'],
            [['keterangan','jumlah','thn_produksi'],'safe'],
       ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = TransaksiMasukDetail::find();

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
            'id_transaksi_masuk' => $this->id_transaksi_masuk,
            'thn_produksi' => $this->thn_produksi,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
