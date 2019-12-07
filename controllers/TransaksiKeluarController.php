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
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;


/**
 * TransaksiKeluarController implements the CRUD actions for TransaksiKeluar model.
 */
class TransaksiKeluarController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'view',
                            'delete',
                            'report',
                        ],
                        'allow' => true,
                        'matchCallback' => function() {
                            return (
                                    Yii::$app->user->identity->AuthKey == 'test100key'
                                    );
                        }
                    ],
                ],
            ],
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

        $dataProvider->pagination->pageSize = 10;

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
            //set tanggal
            $model->tgl_keluar = date('Y-m-d');
            $model->tgl_surat = date('Y-m-d');

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
            //set tanggal
            if ($model->tgl_keluar != null) {
                $model->tgl_keluar = $model->tgl_keluar;
            } if ($model->tgl_surat != null) {
                $model->tgl_surat = $model->tgl_surat;
            } if ($model->tgl_keluar == null) {
                $model->tgl_keluar = date('Y-m-d');
            } if ($model->tgl_surat == null) {
                $model->tgl_surat = date('Y-m-d');
            }
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
    
    public function actionReport(){
         // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report');

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // Folio paper format
            'format' => Pdf::FORMAT_FOLIO,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['Laporan Inventaris Barang Sarana dan Prasarana'],
                'SetFooter' => ['{PAGENO}'],
                'SetTitle' => 'SMAN 2 MALANG',
                'SetSubject' => 'Laporan Inventaris',
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
