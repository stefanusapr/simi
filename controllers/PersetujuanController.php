<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pengajuan;
use app\models\PengajuanSearch;
use app\models\PengajuanBarang;
use app\models\PengajuanBarangSearch;
use app\models\Model;
use kartik\mpdf\Pdf;

/**
 * PengajuanController implements the CRUD actions for Pengajuan model.
 */
class PersetujuanController extends Controller {

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
                            'index-persetujuan',
                            'update',
                            'view',
                            'view-persetujuan',
                            'report',
                        ],
                        'allow' => true,
                        'matchCallback' => function() {
                            if (Yii::$app->user->isGuest) {
                                return Yii::$app->response->redirect(['site/login']);
                            } else {
                                return Yii::$app->user->identity->AuthKey == 'test101key';
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
     * Lists all Pengajuan models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PengajuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;
        
        $countData = $searchModel->search(null)->count; 
        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'countData' => $countData,
        ]);
    }

    public function actionIndexPersetujuan() {
        $searchModel = new PengajuanSearch();
        $dataProvider = $searchModel->searchRiwayat(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index-persetujuan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengajuan model.
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
     * Displays a single Pengajuan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewPersetujuan($id) {
        return $this->render('view-persetujuan', [
                    'model' => $this->findModel($id),
                    'modelDetail' => $this->findDetails($id),
        ]);
    }

    /**
     * Updates an existing Pengajuan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelDetail = $model->pengajuanBarangs;

        if ($model->load(Yii::$app->request->post())) {
            $idLama = ArrayHelper::map($modelDetail, 'id', 'id');
            $modelDetail = Model::createMultiple(PengajuanBarang::classname(), $modelDetail);
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $hapusId = array_diff($idLama, array_filter(ArrayHelper::map($modelDetail, 'id', 'id')));

            //defaul transaksi
            foreach ($modelDetail as $detail) {
                $detail->id_pengajuan = $model->id;
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
                            $detail->id_pengajuan = $model->id;
                            if (!($flag = $detail->save(false))) {

                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        //kirim surel sebagai pemberitahuan ke operator
                        Yii::$app->mailer->compose()
                                ->setFrom('dharmaanugrah97@gmail.com')
                                ->setTo('a.p.stefanus97@gmail.com')
                                ->setSubject('SIMI SMAN 2 MALANG - Pemberitahuan Persetujuan')
                                ->setHtmlBody('Status pengajuan anda telah diperiksa. Terima Kasih!')
                                ->send();
                        //sukses, commit ke db transaksi
                        //kemudian tampilkan hasilnya
                        //update nilai setuju
                        $model->status = 1;
                        $model->update();
                        $transaction->commit();
                        Yii::$app->getSession()->setFlash(
                                'success', 'Selesai memberikan persetujuan'
                        );
                        return $this->redirect(['index']);
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
            $model->tgl_persetujuan = date('Y-m-d');

            // set default value 0 to status
            foreach ($modelDetail as $i => $detail):
                $modelDetail[$i]['status'] = 0;
            endforeach;

            // render view
            return $this->render('update', [
                        'model' => $model,
                        'modelDetail' => (empty($modelDetail)) ? [new PengajuanBarang] : $modelDetail,
            ]);
        }
    }

    /**
     * Finds the Pengajuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengajuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Pengajuan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $detailModel = new PengajuanBarangSearch();
        return $detailModel->search(['PengajuanBarangSearch' => ['id_pengajuan' => $id]]);
    }

    protected function findDetailsReport($id) {
        $detailModel = new PengajuanBarangSearch();
        return $detailModel->searchReport(['PengajuanBarangSearch' => ['id_pengajuan' => $id]]);
    }

    public function actionReport($id) {
        $pengajuan = $this->findModel($id);
        $details = $this->findDetailsReport($id);

        $content = $this->renderPartial('report', [
            'pengajuan' => $pengajuan,
            'details' => $details,
        ]);
//        Yii::$app->response->headers->set($name, $value)
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            //Name for the file
            'filename' => 'Pengajuan',
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
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
            'options' => ['title' => 'Customer Invoice'],
            // call mPDF methods on the fly
            'methods' => [
                //   'SetHeader'=>['Krajee Report Header'], 
                'SetFooter' => ['Halaman {PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

}
