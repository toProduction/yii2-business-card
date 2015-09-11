<?php

namespace app\controllers;

use app\models\Page;
use app\models\Post;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Feedback;
use yii\web\NotFoundHttpException;

/**
 * Class SiteController
 * @package app\controllers
 * @author Ruslan Madatov <ruslanmadatov@yandex.ru>
 */
class SiteController extends Controller
{
    public function behaviors ()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions ()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex ()
    {
        if (!$model = Page::findOne(Yii::$app->params['dbParams']['mainPageId'])) {
            throw new NotFoundHttpException(Yii::t(
                'app',
                'The requested page #{id} does not exist.',
                ['id' => Yii::$app->params['dbParams']['mainPageId']]));
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionLogin ()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout ()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact ()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout ()
    {
        return $this->render('about');
    }

    public function actionPosts ()
    {
        $model = new Post();

        $query = $model->find();
        $query->where(['status' => 'active']);

        $pagination = new Pagination(['totalCount' => $query->count()]);

        $query->limit($pagination->limit);
        $query->offset($pagination->offset);

        return $this->render('posts', [
            'posts' => $query->all(),
        ]);
    }

    public function actionPost ($id)
    {
        if (!$model = Post::findOne(['id' => $id, 'status' => 'active'])) {
            throw new NotFoundHttpException(Yii::t(
                'app',
                'The requested page #{id} does not exist.',
                ['id' => $id]));
        }

        return $this->render('post', [
            'post' => $model
        ]);
    }
}
