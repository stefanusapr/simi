<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pengajuan;
use app\models\PengajuanSearch;
use app\models\PengajuanBarang;
use app\models\PengajuanBarangSearch;
use app\models\Model;

/**
 * PengajuanController implements the CRUD actions for Pengajuan model.
 */
class PengajuanController extends Controller {

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
                            'riwayat',
                            'view',
                            'view-riwayat'
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
     * Lists all Pengajuan models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PengajuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Pengajuan models.
     * @return mixed
     */
    public function actionRiwayat() {
        $searchModel = new PengajuanSearch();
        $dataProvider = $searchModel->searchRiwayat(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('index-riwayat', [
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
    
    public function actionViewRiwayat($id) {
        return $this->render('view-riwayat', [
                    'model' => $this->findModel($id),
                    'modelDetail' => $this->findDetails($id),
        ]);
    }

    /**
     * Creates a new Pengajuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Pengajuan();
        $modelDetail = [new PengajuanBarang];

        // proses isi post variable 
        if ($model->load(Yii::$app->request->post())) {
            $modelDetail = Model::createMultiple(PengajuanBarang::classname());
            Model::loadMultiple($modelDetail, Yii::$app->request->post());

            // assign default id_pengajuan
            foreach ($modelDetail as $detail) {
                $detail->id_pengajuan = 0;
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                                ActiveForm::validateMultiple($modelDetail), ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid1 = $model->validate();
            $valid2 = Model::validateMultiple($modelDetail);
            $valid = $valid1 && $valid2;

            // jika valid, mulai proses penyimpanan
            if ($valid) {
                // mulai database transaction
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    // simpan master record                   
                    if ($flag = $model->save(false)) {
                        // simpan details record
                        foreach ($modelDetail as $modelDetail) {
                            $modelDetail->id_pengajuan = $model->id;
                            if (!($flag = $modelDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        // sukses, commit database transaction
                        // kemudian tampilkan hasilnya
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        return $this->render('create', [
                                    'model' => $model,
                                    'modelDetail' => $modelDetail,
                        ]);
                    }
                } catch (Exception $e) {
                    // penyimpanan galga, rollback database transaction
                    $transaction->rollBack();
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
            $model->tgl_pengajuan = date('Y-m-d');
            // inisialisai id 
            // diperlukan untuk form master-detail
            $model->id = 0;
            // render view
            return $this->render('create', [
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

    protected function findModelBarang($id) {
        if (($model = PengajuanBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $detailModel = new PengajuanBarangSearch();
        return $detailModel->search(['PengajuanBarangSearch' => ['id_pengajuan' => $id]]);
    }

}
