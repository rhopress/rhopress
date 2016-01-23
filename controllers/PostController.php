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
use rhopress\models\Article;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Description of PostController
 *
 * @author vistart <i@vistart.name>
 */
class PostController extends \yii\web\Controller
{

    public $layout = 'post/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['new'],
                'rules' => [
                    [
                        'actions' => ['new'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $article = $this->getArticle($id);
        if (!$article) {
            throw new \yii\web\NotFoundHttpException('Article Not Found.');
        }
        return $this->render('view', ['article' => $article]);
    }

    public function actionNew()
    {
        $article = new Article();
        if ($article->load(Yii::$app->request->post())) {
            if ($article->save()) {
                return $this->redirect(['post/view', 'id' => $article->id]);
            }
        }
        return $this->render('new', ['article' => $article]);
    }

    public function actionDelete($id)
    {
        $article = $this->getArticle($id);
        if (!$article) {
            throw new \yii\web\NotFoundHttpException('Article Not Found.');
        }
        if (!$article->delete()) {
            throw new \yii\web\BadRequestHttpException('Article Delete Failed.');
        }
        return $this->goHome();
    }

    public static function getArticle($id)
    {
        if (is_numeric($id)) {
            $article = Article::find()->id($id)->one();
            if ($article) {
                return $article;
            }
        }
        if (is_string($id)) {
            $article = Article::find()->name($id)->one();
            if ($article) {
                return $article;
            }
        }
        return null;
    }
}
