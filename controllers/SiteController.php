<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'akun'],
                'rules' => [
                    // allow all POST requests
                    [
                        'allow' => true,
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModelBarang = new \app\models\BarangSearch();
        $countBarang = $searchModelBarang->search(null)->TotalCount;

        $searchModelTM = new \app\models\TransaksiMasukSearch();
        $countTM = $searchModelTM->search(null)->TotalCount;

        $searchModelTK = new \app\models\TransaksiKeluarSearch();
        $countTK = $searchModelTK->search(null)->TotalCount;

        $searchModelPinjam = new \app\models\TransaksiKeluarDetailSearch();
        $countPinjam = $searchModelPinjam->searchPeminjaman(null)->TotalCount;

        $searchModelVendor = new \app\models\VendorSearch();
        $countVendor = $searchModelVendor->search(null)->TotalCount;

        $searchModelPengajuan = new \app\models\PengajuanSearch();
        $countPengajuan = $searchModelPengajuan->search(null)->TotalCount;

        $searchModelPersetujuan = new \app\models\PengajuanSearch();
        $countPersetujuan = $searchModelPersetujuan->searchRiwayat(null)->TotalCount;

        return $this->render('index', [
                    'countBarang' => $countBarang,
                    'countTM' => $countTM,
                    'countTK' => $countTK,
                    'countPinjam' => $countPinjam,
                    'countVendor' => $countVendor,
                    'countPengajuan' => $countPengajuan,
                    'countPersetujuan' => $countPersetujuan,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

//return $this->redirect(['/admin/view', 'id' => $model->id]);
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        $model = new LoginForm();
        $model->password = '';
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionChangeMail() {
        $id = Yii::$app->user->identity->id;
        $model = User::findIdentity($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                try {
                    if ($model->validatePassword($_POST['User']['old_password'])) {
                        $model->email = $_POST['User']['email'];
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash(
                                    'success', 'Perubahan email telah disimpan'
                            );
                        }
                    } else {
                        Yii::$app->getSession()->setFlash(
                                'error', 'Konfirmasi password salah!'
                        );
                    }

                    return $this->redirect(['akun']);
                } catch (Exception $e) {
                    Yii::$app->getSession()->setFlash(
                            'error', "{$e->getMessage()}"
                    );
                    return $this->render('akun', [
                                'model' => $model
                    ]);
                }
            } else {
                return $this->render('akun', [
                            'model' => $model
                ]);
            }
        } else {
            return $this->render('akun', [
                        'model' => $model
            ]);
        }
    }

    public function actionAkun() {
        $id = Yii::$app->user->identity->id;
        $model = User::findIdentity($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                try {
                    if ($model->validatePassword($_POST['User']['old_password'])) {
                        if ($_POST['User']['new_password'] == $_POST['User']['repeat_password']) {
                            $model->password = md5($_POST['User']['new_password']);
                            if ($model->save()) {
                                Yii::$app->getSession()->setFlash(
                                        'success', 'Kata sandi berhasil diubah'
                                );
                            }
                        } else {
                            Yii::$app->getSession()->setFlash(
                                    'error', 'Password baru anda tidak valid!'
                            );
                        }
                    } else {
                        Yii::$app->getSession()->setFlash(
                                'error', 'Password lama anda salah!'
                        );
                    }
                    return $this->redirect(['akun']);
                } catch (Exception $e) {
                    Yii::$app->getSession()->setFlash(
                            'error', "{$e->getMessage()}"
                    );
                    return $this->render('akun', [
                                'model' => $model
                    ]);
                }
            } else {
                return $this->render('akun', [
                            'model' => $model
                ]);
            }
        } else {
            return $this->render('akun', [
                        'model' => $model
            ]);
        }
    }

}
