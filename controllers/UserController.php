<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link http://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license http://vistart.name/license/
 */

namespace rhopress\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use rhopress\models\User;
use rhopress\models\RegisterForm;
use yii\web\ForbiddenHttpException;

/**
 * Description of UserController
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class UserController extends \yii\web\Controller
{
    public $layout = 'user/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['me', 'new', 'delete'],
                'rules' => [
                    [
                        'actions' => ['me', 'new', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * List all users.
     * @return type
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 
     * @param string|null $id if empty, it will specify current logged-in user.
     * @return type
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionMe($id = null)
    {
        if (empty($id)) {
            if (Yii::$app->user->isGuest) {
                throw new ForbiddenHttpException('Access Denied.');
            }
            $id = Yii::$app->user->identity->id;
        }
        $user = User::find()->id($id)->one();
        if (!$user) {
            throw new ForbiddenHttpException('Access Denied.');
        }
        return $this->render('me', ['user' => $user]);
    }

    public function actionNew()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['user/index']);
        }
        return $this->render('user', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $user = User::find()->id($id)->one();
        if ($user && $user->delete()) {
            return $this->redirect(['user/index']);
        }
        throw new ForbiddenHttpException('Access Denied.');
    }
}
