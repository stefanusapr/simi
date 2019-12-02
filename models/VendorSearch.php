<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vendor;

/**
 * VendorSearch represents the model behind the search form of `app\models\Vendor`.
 */
class VendorSearch extends Vendor {

    public $cari;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['nama', 'alamat', 'no_hp', 'email', 'keterangan', 'cari'], 'safe'],
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
        $query = Vendor::find();

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
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'alamat', $this->alamat])
                ->andFilterWhere(['like', 'no_hp', $this->no_hp])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'nama', $this->cari])
                ->orFilterWhere(['like', 'alamat', $this->cari])
                ->orFilterWhere(['like', 'no_hp', $this->cari])
                ->orFilterWhere(['like', 'email', $this->cari])
                ->orFilterWhere(['like', 'keterangan', $this->cari]);

        return $dataProvider;
    }

}
