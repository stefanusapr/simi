<?php

namespace app\controllers;

use Yii;
use app\models\TransaksiKeluar;
use app\models\TransaksiKeluarDetail;
use app\models\TransaksiKeluarDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * TransaksiKeluarController implements the CRUD actions for TransaksiKeluar model.
 */
class PeminjamanController extends Controller {

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
                            'view',
                            'selesai',
                            'index-riwayat',
                            'report',
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
     * yang perlu dikembalikan barangnya
     * dengan menampilkan riwayat pengembalian barang
     */
    public function actionIndexRiwayat() {
        $searchModel = new TransaksiKeluarDetailSearch();
        $dataProvider = $searchModel->searchRiwayatPeminjaman(Yii::$app->request->queryParams);

        $session = Yii::$app->session;
        // check if a session is already open
        if (!$session->isActive) {
            $session->open(); // open a session
        }
        // save query here
        $session['repquery'] = Yii::$app->request->queryParams;

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index-riwayat', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * actionSelesai digunakan untuk tombol pengembalian barang
     * dg jenis barang tidak habis pakai
     * di saat pengguna pilih tombol kembali
     * maka kolom tgl_kembali pada model: transaksi detail keluar
     * akan diisi dengan tanggal ketika tombol kembali di klik
     * kemudian tgl tersebut akan di isi ke kolom tgl_kembali
     * sebagai pengembalian barang
     * dan ketika sudah selesai dikembalikan, mak stok pada master barang bertambah sesuai dg jumlah yang dipinjam
     */
    public function actionSelesai($id) {
        $model = $this->findModel($id);

        $model['tgl_kembali'] = date('Y-m-d');
        $model['barang']['stok'] += $model['jumlah'];
        $model->save();
        $model['barang']->save();
        Yii::$app->getSession()->setFlash(
                'success', 'Berhasil mengembalikan barang'
        );
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
        if (($model = TransaksiKeluarDetail::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $detailModel = new TransaksiKeluarDetailSearch();
        return $detailModel->search(['TransaksiKeluarDetailSearch' => ['id_transaksi_keluar' => $id]]);
    }

    protected function findModelKeluar($id) {
        if (($model = TransaksiKeluar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Displays a single TransaksiKeluar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModelKeluar($id),
                    'modelDetail' => $this->findDetails($id),
        ]);
    }

    public function actionReport() {
        $searchModel = new TransaksiKeluarDetailSearch();
        $details = $searchModel->searchRiwayatPeminjaman(Yii::$app->session->get('repquery'));

        $content = $this->renderPartial('report', [
            'modelDetails' => $details,
        ]);

//        Yii::$app->response->headers->set($name, $value)
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            //Name for the file
            'filename' => 'Laporan_Peminjaman',
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
            //'options' => ['title' => 'Customer Invoice'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [],
                'SetFooter' => ['Halaman {PAGENO} {DATETIME}'],
            ]
        ]);
        return $pdf->render();
    }

}
