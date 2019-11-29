<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiKeluar;

/**
 * TransaksiKeluarSearch represents the model behind the search form of `app\models\TransaksiKeluar`.
 */
class TransaksiKeluarSearch extends TransaksiKeluar {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['tgl_keluar', 'tgl_surat', 'nama_penerima', 'keterangan'], 'safe'],
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
        $query = TransaksiKeluar::find();

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
            'tgl_keluar' => $this->tgl_keluar,
            'tgl_surat' => $this->tgl_surat,
        ]);

        $query->andFilterWhere(['like', 'nama_penerima', $this->nama_penerima])
              ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }

}
