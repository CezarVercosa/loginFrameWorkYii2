<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'main', 'about'], 
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'], // Permitir acesso apenas para usuários não autenticados
                    ],
                    [
                        'allow' => true,
                        'actions' => ['main'],
                        'roles' => ['@'], // Permitir acesso apenas para usuários autenticados
                    ],
                    [
                        'allow' => true,
                        'actions' => ['about'],
                        'roles' => ['@'], // Permitir acesso apenas para usuários autenticados
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                   
                    if (!Yii::$app->user->isGuest && $action->id === 'login') {
                        return $this->redirect(['/site/index']); 
                    }
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']); 
        }
        
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';

       
        $model = new LoginForm();

        // Verifica se o formulário foi submetido e tenta realizar o login
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Se o login for bem-sucedido, redireciona para a página inicial
            return $this->goHome();
        }

        // Se não houver tentativa de login bem-sucedida, exibe a página de login novamente
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('PHPSESSID');
        $cookies->remove('_identity');
        Yii::$app->user->logout();

        return $this->redirect(['/site/login']);
    }

    
    

    /**
     * Displays contact page.
     *
     * @return Response|string
     */

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
