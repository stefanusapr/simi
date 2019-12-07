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
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
// deny all POST requests
                    [
                        'allow' => false,
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
        return $this->render('index');
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
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionAkun() {
        $id = Yii::$app->user->identity->id;
        $model = User::findIdentity($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                try {
                    if ($model->validatePassword($_POST['User']['password_old'])) {
                        $model->password = $_POST['User']['password_new'];
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash(
                                    'success', 'Kata sandi berhasil diubah'
                            );
                        }
                    } else {
                        Yii::$app->getSession()->setFlash(
                                'error', 'Kata sandi tidak berubah'
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
            $model->password_old = '';
            $model->password_new = '';
            $model->password_repeat = '';
            return $this->render('akun', [
                        'model' => $model
            ]);
        }
    }

}
