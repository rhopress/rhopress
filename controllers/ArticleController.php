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
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class ArticleController extends \yii\web\Controller
{

    public $layout = 'article/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['new', 'delete'],
                'rules' => [
                    [
                        'actions' => ['new'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
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

    public function actions()
    {
        return [
            'view' => [
                'class' => 'rhopress\controllers\article\ViewAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNew()
    {
        $article = new Article();
        if ($article->load(Yii::$app->request->post())) {
            if ($article->save()) {
                return $this->redirect(['article/view', 'id' => $article->id]);
            }
        }
        return $this->render('new', ['article' => $article]);
    }

    public function actionDelete($id)
    {
        $article = static::getArticle($id);
        if ($article->user->guid != Yii::$app->user->identity->guid) {
            throw new \yii\web\ForbiddenHttpException('Delete Denied.');
        }
        if (!$article->delete()) {
            throw new \yii\web\BadRequestHttpException('Article Delete Failed.');
        }
        return $this->goHome();
    }

    /**
     * 
     * @param string|integer $id
     * @param boolean $throwExceptionIfNull
     * @return Article
     * @throws \yii\web\NotFoundHttpException
     */
    public static function getArticle($id, $throwExceptionIfNull = true)
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
        if ($throwExceptionIfNull) {
            throw new \yii\web\NotFoundHttpException(static::t('Article Not Found.'));
        }
        return null;
    }

    public static function t($message, $params = [], $language = null)
    {
        return \rhopress\Module::t('controllers/article', $message, $params, $language);
    }
}
