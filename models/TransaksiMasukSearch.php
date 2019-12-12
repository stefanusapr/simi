<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiMasuk;
use kartik\daterange\DateRangeBehavior;

/**
 * TransaksiMasukSearch represents the model behind the search form of `app\models\TransaksiMasuk`.
 */
class TransaksiMasukSearch extends TransaksiMasuk {

    public $cari;
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;

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
            [['id', 'id_vendor'], 'integer'],
            [['tgl_spk', 'tgl_masuk', 'no_faktur', 'tgl_faktur', 'no_berita_acara', 'tgl_berita_acara', 'no_pemeriksaan', 'tgl_pemeriksaan', 'keterangan', 'cari'], 'safe'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['vendor.nama'], 'safe']
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
        $query = TransaksiMasuk::find();

        // add conditions that should always apply here
        $this->createTimeStart = strtotime($this->createTimeStart);
        $this->createTimeEnd = strtotime(date('Y-m-d'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['vendor.nama'] = [
            'asc' => ['vendor.nama' => SORT_ASC],
            'desc' => ['vendor.nama' => SORT_DESC],
        ];
        
        $query->joinWith(['vendor']); 

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tgl_spk' => $this->tgl_spk,
            //'tgl_masuk' => $this->tgl_masuk,
            'id_vendor' => $this->id_vendor,
            'tgl_faktur' => $this->tgl_faktur,
            'tgl_berita_acara' => $this->tgl_berita_acara,
            'tgl_pemeriksaan' => $this->tgl_pemeriksaan,
        ]);

        $query->andFilterWhere(['like', 'no_faktur', $this->no_faktur])
                ->andFilterWhere(['like', 'no_berita_acara', $this->no_berita_acara])
                ->andFilterWhere(['like', 'no_pemeriksaan', $this->no_pemeriksaan])
                ->andFilterWhere(['like', 'transaksiMasuk.keterangan', $this->keterangan])
                ->orFilterWhere(['like', 'no_faktur', $this->cari])
                ->orFilterWhere(['like', 'no_berita_acara', $this->cari])
                ->orFilterWhere(['like', 'no_pemeriksaan', $this->cari])
                ->orFilterWhere(['like', 'vendor.keterangan', $this->cari])
                ->orFilterWhere(['like', 'vendor.nama', $this->cari]);

        $query->andFilterWhere(['>=', 'tgl_masuk', date('Y-m-d', ($this->createTimeStart))])
                ->andFilterWhere(['<=', 'tgl_masuk', date('Y-m-d', ($this->createTimeEnd))]);

        return $dataProvider;
    }

}
