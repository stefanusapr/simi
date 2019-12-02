<?php

namespace app\controllers;

use Yii;
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
class TransaksiKeluarController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TransaksiKeluar models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransaksiKeluarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize=5;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransaksiKeluar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelDetail' => $this->findDetails($id),
        ]);
    }

    /**
     * Creates a new TransaksiKeluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TransaksiKeluar();
        $modelDetail = [new TransaksiKeluarDetail];

        // proses isi post variabel
        if ($model->load(Yii::$app->request->post())) {
            $modelDetail = Model::createMultiple(TransaksiKeluarDetail::classname());
            Model::loadMultiple($modelDetail, Yii::$app->request->post());

            //defaul transaksi
            foreach ($modelDetail as $detail) {
                $detail->id_transaksi_keluar = 0;
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                                ActiveForm::validateMultiple($modelDetail), ActiveForm::validate($model)
                );
            }

            //validasi semua model
            $valid1 = $model->validate();
            $valid2 = Model::validateMultiple($modelDetail);
            $valid = $valid1 && $valid2;

            //jika valid, mulai proses menyimpan
            if ($valid) {
                //start db transaction
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    //simpan ke master record
                    if ($flag = $model->save(false)) {
                        //simpan details record
                        foreach ($modelDetail as $modelDetail) {
                            $modelDetail->id_transaksi_keluar = $model->id;
                            if (!($flag = $modelDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        //sukses comit db transaksi dan tampilkan hasilnya
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('create', [
                                    'model' => $model,
                                    'modeldetail' => $modelDetail,
                        ]);
                    }
                } catch (Exceptation $e) {
                    //penyimpannan gagal, maka rollback db transaksi
                    $transaksi->rollBack();
                    throw $e;
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelDetail' => $modelDetail,
                            'error' => 'valid1: ' . print_r($valid1, true) . ' - valid2: ' . print_r($valid2, true),
                ]);
            }
        } else {
            $model->id = 0;
            // render view
            return $this->render('create', [
                        'model' => $model,
                        'modelDetail' => (empty($modelDetail)) ? [new TransaksiKeluarDetail] : $modelDetail,
            ]);
        }
    }

    /**
     * Updates an existing TransaksiKeluar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelDetail = $model->transaksiKeluarDetails;

        if ($model->load(Yii::$app->request->post())) {
            $idLama = ArrayHelper::map($modelDetail, 'id', 'id');
            $modelDetail = Model::createMultiple(TransaksiKeluarDetail::classname(), $modelDetail);
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $hapusId = array_diff($idLama, array_filter(ArrayHelper::map($modelDetail, 'id', 'id')));

            //defaul transaksi
            foreach ($modelDetail as $detail) {
                $detail->id_transaksi_keluar = $model->id;
            }

            //validasi ajax
            if (Yii::$app->request->isAjax) {
                Yii::$app->request->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                                ActiveForm::validateMultiple($modelDetail), ActiveForm::validate($model));
            }

            //validasi semua model
            $valid1 = $model->validate();
            $valid2 = Model::validateMultiple($modelDetail);
            $valid = $valid1 && $valid2;

            //jika valid semua modelnya, maka proses untuk menyimpan
            if ($valid) {
                //mulai db transaksinya
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        //hapus dulu semua recordnya yg tersimpan pd db
                        if (!empty($hapusId)) {
                            TransactionDetails::deleteAll(['id' => $hapusId]);
                        }
                        //selanjutnya simpan transaksi detail ke record
                        foreach ($modelDetail as $detail) {
                            $detail->id_transaksi_keluar = $model->id;
                            if (!($flag = $detail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        //sukses, commit ke db transaksi
                        //kemudian tampilkan hasilnya
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exceptation $e) {
                    //penyimpannan gagal, maka rollback db transaksi
                    $transaksi->rollBack();
                    throw $e;
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelDetail' => $modelDetail,
                            'error' => 'valid1: ' . print_r($valid1, true) . ' - valid2: ' . print_r($valid2, true),
                ]);
            }
        } else {
            // render view
            return $this->render('update', [
                        'model' => $model,
                        'modelDetail' => (empty($modelDetail)) ? [new TransaksiKeluarDetail] : $modelDetail,
            ]);
        }
    }

    /**
     * Deletes an existing TransaksiKeluar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $modelDetail = $model->transaksiKeluarDetails;

        //mulai db transaksi
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //hapus dahulu pd transaksi detailnya
            foreach ($modelDetail as $detail) {
                $detail->delete();
            }
            //kemudian hapus ke transaksi yg besar
            $model->delete();

            //jika sukses, commit transaksi
            $transaction->commit();
        } catch (Exception $ex) {
            //jika gagal, rollback db transaksi
            $transaction->rollBack();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransaksiKeluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiKeluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TransaksiKeluar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $detailModel = new TransaksiKeluarDetailSearch();
        return $detailModel->search(['TransaksiKeluarDetailSearch' => ['id_transaksi_keluar' => $id]]);
    }

}
