<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KirimPesan;
use app\models\Vendor;

/**
 * VendorSearch represents the model behind the search form of `app\models\KirimPesan`.
 */
class KirimPesanSearch extends KirimPesan {

    public $cari;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'id_vendor'], 'integer'],
            [['judul', 'isi_pesan'], 'string'],
            [['waktu_kirim'], 'safe'],
            [['id_vendor'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['id_vendor' => 'id']],
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
        $query = KirimPesan::find();

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
            'id_vendor' => $this->id_vendor,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
                ->andFilterWhere(['like', 'isi_pesan', $this->isi_pesan]);

        return $dataProvider;
    }

}
