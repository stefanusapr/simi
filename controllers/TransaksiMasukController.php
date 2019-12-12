<?php

namespace app\controllers;

use Yii;
use app\models\TransaksiMasuk;
use app\models\TransaksiMasukDetail;
use app\models\TransaksiMasukDetailSearch;
use app\models\TransaksiMasukSearch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use app\models\Vendor;
use app\models\Barang;

/**
 * TransaksiMasukController implements the CRUD actions for TransaksiMasuk model.
 */
class TransaksiMasukController extends Controller {

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
                            'create-vendor',
                            'create-barang'
                        ],
                        'allow' => true,
                        'matchCallback' => function() {
                            if (Yii::$app->user->isGuest) {
                                return Yii::$app->response->redirect(['site/login']);
                            } else {
                                return Yii::$app->user->identity->AuthKey == 'test100key';
                            }
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
     * Lists all TransaksiMasuk models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransaksiMasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;
        
        $session = Yii::$app->session;
        // check if a session is already open
        if (!$session->isActive) {
            $session->open(); // open a session
        }
        // save query here
        $session['repquery'] = Yii::$app->request->queryParams;
        
//        var_dump(Yii::$app->request->queryParams['TransaksiMasukSearch']['cari']);exit;
//                
//        if (Yii::$app->request->queryParams['TransaksiMasukSearch']['createTimeRange'] || Yii::$app->request->queryParams['sort']) {
////            $searchModel->createTimeRange = Yii::$app->request->queryParams['TransaksiMasukSearch']['createTimeRange'];
//        } else {
//            $searchModel->createTimeRange = $searchModel->createTimeRange = date('Y').'-01-01 - ' . date('Y-m-d');
//        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransaksiMasuk model.
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
     * Creates a new TransaksiMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TransaksiMasuk();
        $modelDetail = [new TransaksiMasukDetail];

        // proses isi post variabel
        if ($model->load(Yii::$app->request->post())) {
            $modelDetail = Model::createMultiple(TransaksiMasukDetail::classname());
            Model::loadMultiple($modelDetail, Yii::$app->request->post());

            //defaul transaksi
            foreach ($modelDetail as $detail) {
                $detail->id_transaksi_masuk = 0;
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
                        foreach ($modelDetail as $i => $detail) {
                            $detail->id_transaksi_masuk = $model->id;
                            $detail->barang->stok += Yii::$app->request->post()['TransaksiMasukDetail'][$i]['jumlah'];
                            if (!($flag = ( $detail->save(false) && $detail->barang->save(false) ))) {
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
            $model->tgl_spk = date('Y-m-d');
            $model->tgl_masuk = date('Y-m-d');
            $model->tgl_faktur = date('Y-m-d');
            $model->tgl_berita_acara = date('Y-m-d');
            $model->tgl_pemeriksaan = date('Y-m-d');

            $model->id = 0;
            // render view
            return $this->render('create', [
                        'model' => $model,
                        'modelDetail' => (empty($modelDetail)) ? [new TransaksiMasukDetail] : $modelDetail,
            ]);
        }
    }

    /**
     * Updates an existing TransaksiMasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelDetail = $model->transaksiMasukDetails;

        if (Yii::$app->request->post()) {
            foreach ($modelDetail as $i => $detail) {
                //menambah stok barang
                $result = Yii::$app->request->post()['TransaksiMasukDetail'][$i]['jumlah'] - $detail->jumlah;
                $detail->barang->stok += $result;

                //simpan ke variable lain(mas yudha) supaya ga kereplace
                $varBarangStok[$i] = $detail->barang->stok;
            }

            $model->load(Yii::$app->request->post());

            $idLama = ArrayHelper::map($modelDetail, 'id', 'id');
            $modelDetail = Model::createMultiple(TransaksiMasukDetail::classname(), $modelDetail);
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $hapusId = array_diff($idLama, array_filter(ArrayHelper::map($modelDetail, 'id', 'id')));

            //defaul transaksi
            foreach ($modelDetail as $detail) {
                $detail->id_transaksi_masuk = $model->id;
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
                        foreach ($modelDetail as $i => $detail) {
                            $detail->id_transaksi_masuk = $model->id;

                            // replace stok dengan hasil kalkulasi
                            // mas yudha bilang ke ibu (info terbaru)
                            $detail->barang->stok = $varBarangStok[$i];

                            //setelah && ibu nulis data terbaru
                            if (!($flag = ( $detail->save(false) && $detail->barang->save(false) ))) {
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
            if ($model->tgl_spk != null) {
                $model->tgl_spk = $model->tgl_spk;
            } if ($model->tgl_faktur != null) {
                $model->tgl_faktur = $model->tgl_faktur;
            } if ($model->tgl_pemeriksaan != null) {
                $model->tgl_pemeriksaan = $model->tgl_pemeriksaan;
            } if ($model->tgl_berita_acara != null) {
                $model->tgl_berita_acara = $model->tgl_berita_acara;
            } if ($model->tgl_spk == null) {
                $model->tgl_spk = date('Y-m-d');
            } if ($model->tgl_faktur == null) {
                $model->tgl_faktur = date('Y-m-d');
            } if ($model->tgl_pemeriksaan == null) {
                $model->tgl_pemeriksaan = date('Y-m-d');
            } if ($model->tgl_berita_acara == null) {
                $model->tgl_berita_acara = date('Y-m-d');
            }

            // render view
            return $this->render('update', [
                        'model' => $model,
                        'modelDetail' => (empty($modelDetail)) ? [new TransaksiMasukDetail] : $modelDetail,
            ]);
        }
    }

    /**
     * Deletes an existing TransaksiMasuk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $modelDetail = $model->transaksiMasukDetails;

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
     * Finds the TransaksiMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TransaksiMasuk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $detailModel = new TransaksiMasukDetailSearch();
        return $detailModel->search(['TransaksiMasukDetailSearch' => ['id_transaksi_masuk' => $id]]);
    }

    public function actionReport() {
        $searchModel = new TransaksiMasukSearch();
        $details = $searchModel->search(Yii::$app->session->get('repquery'));

        $content = $this->renderPartial('report', [
            'modelDetails' => $details,
        ]);

//        Yii::$app->response->headers->set($name, $value)
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            //Name for the file
            'filename' => 'Laporan_Transaksi_Masuk',
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'marginTop' => 5,
            'marginLeft' => 5,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            //'options' => ['title' => 'Customer Invoice'],
            // call mPDF methods on the fly
            'methods' => [
                //   'SetHeader'=>['Krajee Report Header'], 
                'SetFooter' => ['Halaman {PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionCreateVendor($id = null) {

        if ($id == null) {
            Url::remember(['transaksi-masuk/create'], 'tm-create');
        } else {
            Url::remember(['transaksi-masuk/update', 'id' => $id], 'tm-edit');
        }

        return $this->redirect(['vendor/create']);
    }

    public function actionCreateBarang() {

        Url::remember(['transaksi-masuk/create'], 'tm-create');

        return $this->redirect(['barang/create']);
    }

}
