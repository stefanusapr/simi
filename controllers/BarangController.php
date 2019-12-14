<?php

namespace app\controllers;

use Yii;
use app\models\Barang;
use app\models\BarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use yii\helpers\Url;

/**
 * BarangController implements the CRUD actions for Barang model.
 */
class BarangController extends Controller {

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
                            'report-details',
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
                    [
                        'actions' => [
                            'index-waka',
                            'view-waka',
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
     * Lists all Barang models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Barang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $searchModel = new BarangSearch();

        $dataProviderTM = $searchModel->searchTMByID(Yii::$app->request->queryParams, $id);
        $dataProviderTK = $searchModel->searchTKByID(Yii::$app->request->queryParams, $id);

        $dataProviderTM->pagination->pageSize = 5;
        $dataProviderTK->pagination->pageSize = 5;


        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'dataProviderTM' => $dataProviderTM,
                    'dataProviderTK' => $dataProviderTK,
        ]);
    }

    /**
     * Lists all Barang models.
     * @return mixed
     */
    public function actionIndexWaka() {
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index-waka', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Barang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewWaka($id) {
        return $this->render('view-waka', [
                    'model' => $this->findModel($id),
                        //'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Barang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Barang();

        if ($model->load(Yii::$app->request->post())) {

            $model->stok = 0;

            if ($model->save()) {
                if (Url::previous('tm-create')) {
                    $var = Url::previous('tm-create');
                    Yii::$app->session->remove('tm-create');
                    Yii::$app->getSession()->setFlash(
                            'success', 'Berhasil menambahkan barang : <b>' . $model->nama
                    );
                    return $this->redirect($var);
                } else {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Barang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Barang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $model = $this->findModel($id);
            $model->delete();
        } catch (\yii\db\IntegrityException $ex) {
            if (1451 == $ex->errorInfo[1]) {
                // Your message goes here
                $msg = 'Barang: <b>' . $model->nama . '</b>, Merk : <b>' . $model->merk .'</b> Gagal dihapus karena memiliki relasi';
            } else {
                $msg = 'Gagal menghapus barang';
            }

            if (isset($_GET['ajax'])) {
                throw new HttpException(400, $msg);
            } else {
                Yii::$app->getSession()->setFlash(
                        'error', $msg
                );
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Barang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Barang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Barang::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReport() {
        $searchModel = new BarangSearch();
        $details = $searchModel->search(Yii::$app->request->queryParams);

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
                //   'SetHeader'=>['Krajee Report Header'], 
                'SetFooter' => ['Halaman {PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    //cetak info barang yang di dalam report-detail setelah klik view
    public function actionReportDetails($id) {
        $searchModel = new BarangSearch();
        $details = $searchModel->search(Yii::$app->request->queryParams);

        $searchModel = new BarangSearch();

        $dataProviderTM = $searchModel->searchTMByID(Yii::$app->request->queryParams, $id);
        $dataProviderTK = $searchModel->searchTKByID(Yii::$app->request->queryParams, $id);

        $content = $this->renderPartial('report-details', [
            'modelDetails' => $details,
        ]);

//        Yii::$app->response->headers->set($name, $value)
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            //Name for the file
            'filename' => 'Laporan Barang Detail',
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

}
