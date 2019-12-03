<?php

namespace app\controllers;

use Yii;
use DateTime;
use app\models\TransaksiKeluar;
use app\models\TransaksiKeluarSearch;
use app\models\TransaksiKeluarDetail;
use app\models\TransaksiKeluarDetailSearch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * TransaksiKeluarController implements the CRUD actions for TransaksiKeluar model.
 */
class PeminjamanController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'selesai' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TransaksiKeluar models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransaksiKeluarDetailSearch();
        $dataProvider = $searchModel->searchPeminjaman(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 
     * @return 
     * actionRiwayat untuk menampilkan data transaksi keluar dg jenis barang tidak habis pakai
     * yang pelu di kembalikan barangnya
     * dengan menampilkan riwayat pengembalian barang
     */
    public function actionRiwayat() {
        $searchModel = new TransaksiKeluarDetailSearch();
        $dataProvider = $searchModel->searchRiwayatPeminjaman(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index-riwayat', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSelesai($id) {
        $model = $this->findModel($id);
        
        $model['tgl_kembali'] = date('Y-m-d');
        
        $model->save();              
        
        return $this->redirect(['riwayat']);
    }

    /**
     * Finds the TransaksiKeluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiKeluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TransaksiKeluarDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $detailModel = new TransaksiKeluarDetailSearch();
        return $detailModel->search(['TransaksiKeluarDetailSearch' => ['id_transaksi_keluar' => $id]]);
    }

}
