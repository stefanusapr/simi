<?php

namespace app\controllers;

use Yii;
use app\models\Vendor;
use app\models\VendorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\KirimPesan;
use app\models\KirimPesanSearch;
use yii\helpers\Url;

/**
 * VendorController implements the CRUD actions for Vendor model.
 */
class VendorController extends Controller {

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
                            'email',
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
     * Lists all Vendor models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        Url::remember(['vendor/index'], 'vendor-index');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vendor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'kirimPesan' => $this->findDetails($id),
        ]);
    }

    /**
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Vendor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // cek session dari halaman yg mana transaksi-masuk edit
            if (Url::previous('tm-edit')) {
                $var = Url::previous('tm-edit');
                Yii::$app->session->remove('tm-edit');
                return $this->redirect($var);
            } else if (Url::previous('tm-create')) {
                $var = Url::previous('tm-create');
                Yii::$app->session->remove('tm-create');
                return $this->redirect($var);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vendor model.
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
     * Deletes an existing Vendor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vendor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Vendor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetails($id) {
        $kirimPesan = new KirimPesanSearch();
        return $kirimPesan->search(['KirimPesanSearch' => ['id_vendor' => $id]]);
    }

    /**
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionEmail($id) {
        $model = $this->findModel($id);
        $kirimPesan = new KirimPesan();

        // proses isi post variabel
        if ($kirimPesan->load(Yii::$app->request->post())) {
            $kirimPesan->waktu_kirim = date('Y-m-d H:i:s');
            $kirimPesan->id_vendor = $id;
            if ($kirimPesan->validate()) {
                //start db transaction
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    //simpan ke master record
                    if ($flag = $model->save(false)) {
                        if (!($flag = $kirimPesan->save(false))) {
                            $transaction->rollBack();
                            // break;
                        }
                    }
                    if ($flag) {
                        $berhasilSendEmail = Yii::$app->mailer->compose()
                                ->setFrom('dharmaanugrah97@gmail.com')
                                ->setTo($model->email)
                                ->setSubject($kirimPesan->judul)
                                ->setHtmlBody($kirimPesan->isi_pesan)
                                ->send();
                        if ($berhasilSendEmail) {
                            Yii::$app->getSession()->setFlash(
                                    'success', 'Berhasil mengirim pesan ke Vendor ' . $model->nama
                            );
                            //sukses comit db transaksi dan tampilkan hasilnya
                            $transaction->commit();
                        }
                        return $this->redirect(['index']);
                    } else {
                        return $this->render('create-email', [
                                    'model' => $model,
                                    'kirimPesan' => $kirimPesan,
                        ]);
                    }
                } catch (Exceptation $e) {
                    //penyimpannan gagal, maka rollback db transaksi
                    $transaksi->rollBack();
                    throw $e;
                }
            } else {
                return $this->render('create-email', [
                            'model' => $model,
                            'kirimPesan' => $kirimPesan,
                ]);
            }
        } else {
//            $model->id = 0;
            // render view
            return $this->render('create-email', [
                        'model' => $model,
                        'kirimPesan' => (empty($kirimPesan)) ? [new KirimPesan] : $kirimPesan,
            ]);
        }
    }

}
