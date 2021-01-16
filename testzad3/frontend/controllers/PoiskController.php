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

/**
 * Site controller
 */
class PoiskController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return
            [
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
     * Displays contact page.
     *
     * @return mixed
     */


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionNew()
    {
        $query = Product::find()->where(['hit' => '1'])->orderBy('addtime desc');;
        $countQuery = clone $query;
        $pages = new Pagination(
            ['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        $email = Yii::$app->request->get('email');
        if ($email != "") {
            $model = new Raspis;
            $model->email = $email;
            $model->insert();
        }
        return $this->render('new', compact('hits', 'pages'));
    }

    public function actionWozzap()
    {
        $query = Product::find()->where(['hit' => '1'])->orderBy('price asc');;
        $countQuery = clone $query;
        $pages = new Pagination(
            ['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        $email = Yii::$app->request->get('email');
        if ($email != "") {
            $model = new Raspis;
            $model->email = $email;
            $model->insert();
        }
        return $this->render('wozzap', compact('hits', 'pages'));
    }

    public function actionUbzap()
    {
        $query = Product::find()->where(['hit' => '1'])->orderBy('price desc');;
        $countQuery = clone $query;
        $pages = new Pagination(
            ['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        $email = Yii::$app->request->get('email');
        if ($email != "") {
            $model = new Raspis;
            $model->email = $email;
            $model->insert();
        }
        return $this->render('ubzap', compact('hits', 'pages'));
    }

    public function actionMuh()
    {
        $query = Product::find()->where(['pol' => 'мужчина']);
        $countQuery = clone $query;
        $pages = new Pagination(
            ['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        $email = Yii::$app->request->get('email');
        if ($email != "") {
            $model = new Raspis;
            $model->email = $email;
            $model->insert();
        }
        return $this->render('muh', compact('hits', 'pages'));
    }

    public function actionZen()
    {
        $query = Product::find()->where(['pol' => 'женщина']);
        $countQuery = clone $query;
        $pages = new Pagination(
            ['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]
        );
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        $email = Yii::$app->request->get('email');
        if ($email != "") {
            $model = new Raspis;
            $model->email = $email;
            $model->insert();
        }
        return $this->render('zen', compact('hits', 'pages'));
    }
}