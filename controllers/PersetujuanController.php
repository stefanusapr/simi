<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
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
class PersetujuanController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'view', 'persetujuan'],
                'rules' => [
                    // deny all POST requests
                    [
                        'allow' => false,
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['waka'],
                    ],
                // everything else is denied
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

    public function actionPersetujuan() {
        $searchModel = new PengajuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

}
