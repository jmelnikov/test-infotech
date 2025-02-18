<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin(): Response|string
    {
        $userModel = new User();
        if ($userModel->load(Yii::$app->request->post())) {
            $user = User::findByUsername($userModel->username);
            if ($user && $user->validatePassword($userModel->password_hash)) {
                Yii::$app->user->login($user);

                return $this->goHome();
            }
        }

        return $this->render('login', ['user' => $userModel]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @throws Exception
     */
    public function actionRegister(): Response|string
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post())) {
            $user->setPassword($user->password_hash);
            $user->generateAuthKey();
            $user->created_at = time();

            if ($user->save()) {
                Yii::$app->user->login($user);

                return $this->goHome();
            }
        }

        return $this->render('register', ['user' => $user]);
    }
}
