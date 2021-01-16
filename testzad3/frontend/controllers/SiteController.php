<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Interview;
use frontend\models\Article;
use yii\db\ActiveRecord;
use frontend\models\Category;
use frontend\models\Product;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
    public function actions()
    {
        return [
            'captcha' => [
                // 'class' => 'yii\captcha\CaptchaAction',
                'class' => 'frontend\common\NumericCaptcha',
                'minLength' => 3,
                'maxLength' => 4,
                'height' => 40,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            //...
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */


    public function actionIndex()
    {
        $model = new Product();
        $price = trim(Yii::$app->request->get('price'));
        $city = trim(Yii::$app->request->get('city[]'));
        $spez = trim(Yii::$app->request->get('spez'));
        $nahzap = trim(Yii::$app->request->get('nahzap'));
        $konzap = trim(Yii::$app->request->get('konzap'));
        $nahzap = trim(Yii::$app->request->get('nahwoz'));
        $konzap = trim(Yii::$app->request->get('konwoz'));
        $polz = trim(Yii::$app->request->get('polz'));
        $hasz = trim(Yii::$app->request->get('hasz'));
        $prz = trim(Yii::$app->request->get('prz'));
        $wol = trim(Yii::$app->request->get('wol'));
        $staz = trim(Yii::$app->request->get('staz'));
        $pold = trim(Yii::$app->request->get('pold'));
        $smeng = trim(Yii::$app->request->get('smeng'));
        $udal = trim(Yii::$app->request->get('udal'));
        $waht = trim(Yii::$app->request->get('waht'));
        $bez = trim(Yii::$app->request->get('bez'));
        $per1 = trim(Yii::$app->request->get('per1'));
        $per2 = trim(Yii::$app->request->get('per2'));
        $per3 = trim(Yii::$app->request->get('per3'));
        $query = Product::find();
        if ($price != "") {
            $query = Product::find()->where(['price' => $price]);
        }
        if (($city != "") and ($city != 'Выберете город')) {
            $query = Product::find()->where(['city' => $city]);
        }
        if (($spez != "") and ($spez != 'Выберете специализацию')) {
            $query = Product::find()->where(['spez' => $spez]);
        }
        if (($nahzap != "") and ($konzap != "")) {
            $query = Product::find()->where(['>=', 'price', $nahzap])->andwhere(['<=', 'price', $konzap]);
        }
        if (($nahwoz != "") and ($konwoz != "")) {
            $query = Product::find()->where(['>=', 'wozr', $nahwoz])->andwhere(['<=', 'wozr', $konwoz]);
        }
        if ($polz != "") {
            $query = Product::find()->where(['zan' => $polz]);
        }
        if ($hasz != "") {
            $query = Product::find()->where(['zan' => $hasz]);
        }
        if ($prz != "") {
            $query = Product::find()->where(['zan' => $prz]);
        }
        if ($wol != "") {
            $query = Product::find()->where(['zan' => $wol]);
        }
        if ($staz != "") {
            $query = Product::find()->where(['zan' => $staz]);
        }
        if ($pold != "") {
            $query = Product::find()->where(['grafrab' => $pold]);
        }
        if ($smeng != "") {
            $query = Product::find()->where(['grafrab' => $smeng]);
        }
        if ($udal != "") {
            $query = Product::find()->where(['grafrab' => $udal]);
        }
        if ($waht != "") {
            $query = Product::find()->where(['grafrab' => $waht]);
        }
        if ($bez != "") {
            $query = Product::find()->where(['keywords' => $bez]);
        }
        if ($per1 != "") {
            $query = Product::find()->where(['keywords' => $per1]);
        }
        if ($per2 != "") {
            $query = Product::find()->where(['keywords' => $per2]);
        }
        if ($per3 != "") {
            $query = Product::find()->where(['keywords' => $per3]);
        }
        if (($price != "") and ($city != "") and ($city != 'Выберете город ...') and ($spez != "")) {
            $query = Product::find()->where(['price' => $price, 'city' => $city, 'spez' => $spez]);
        }
        if (($price != "") and ($city = "") and ($city != 'Выберете город ...') and ($spez != "") and ($grafrab != "")) {
            $query = Product::find()->where(
                ['price' => $price, 'city' => $city, 'spez' => $spez, 'grafrab' => $grafrab]
            );
        }
        $countQuery = clone $query;
        $pages = new Pagination(
            ['totalCount' => $countQuery->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('hits', 'pages', 'model', 'price', 'nahzap', 'konzap'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render(
                'login',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash(
                    'success',
                    'Thank you for contacting us. We will respond to you as soon as possible.'
                );
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render(
                'contact',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionbackend()
    {
        return $this->render('backend');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash(
                'success',
                'Thank you for registration. Please check your inbox for verification email.'
            );
            return $this->goHome();
        }

        return $this->render(
            'signup',
            [
                'model' => $model,
            ]
        );
    }

    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));

        if (!$q) {
            return $this->render('search');
            throw new \yii\web\HttpException(404, 'работает');
        } else {
            throw new \yii\web\HttpException(404, 'не работает');
        }

        if (empty($q)) {
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }

        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(
            ['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash(
                    'error',
                    'Sorry, we are unable to reset password for the provided email address.'
                );
            }
        }

        return $this->render(
            'requestPasswordResetToken',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render(
            'resetPassword',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash(
                'error',
                'Sorry, we are unable to resend verification email for the provided email address.'
            );
        }

        return $this->render(
            'resendVerificationEmail',
            [
                'model' => $model
            ]
        );
    }
}