<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\Register;
use yii\web\Controller;
use yii\filters\AccessControl;

class MainController extends Controller
{
    public function behaviors() {
        return [
            "access" => [
                "class" => AccessControl::class,
                "only" => ["index", "login", "register", "logout"],
                "rules" => [
                    [
                        "actions" => ["index", "logout"],
                        "allow" => true,
                        "roles" => ['@']
                    ],
                    [
                        "actions" => ["login", "register"],
                        "allow" => true,
                        "roles" => ['?']
                    ]
                ]
            ]
        ];
    }

    public function actions() {
        return [
            "error" => [
                "class" => 'yii\web\ErrorAction',
                "layout" => "error"
            ]
        ];
    }

	public function actionIndex() {
		return $this->render("index");
	}

	public function actionLogin()
    {
        $this->layout = "login";
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister() {
        $this->layout = "login";
        $model = new Register();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->secret != "platforma_va_test") {
                Yii::$app->session->setFlash("secret-pass-error", "Maxfiy parolni noto'g'ri kiritdingiz!");
                $model->password = '';
                $model->secret = '';
                return $this->render("register", ['model' => $model]);
            }
            if ($model->register()) {
                $login = new LoginForm();
                $login->login = $model->login;
                $login->password = $model->password;
                if ($login->login()) {
                    return $this->redirect(['main/index']);
                }
                Yii::$app->session->setFlash("login-error-in-reg-action", "Ro'yxatdan o'tish muvofaqayatli amalga oshirildi. Faqat tizimga kirishda muammo yuzaga keldi! Login va parolni kiritib tizimga kiring");
                return $this->redirect(['main/login']);
            }
        }

        return $this->render("register", compact("model"));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}