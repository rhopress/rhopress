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

/**
 * Description of PostController
 *
 * @author vistart <i@vistart.name>
 */
class PostController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->route;
    }

    public function actionView($id)
    {
        return var_dump(static::checkArticleExists($id));
    }

    public function actionNew()
    {
        $article = new Article();
        if (Yii::$app->request->isPost) {
            $article->load(Yii::$app->request->post());
            var_dump($article->attributes);
            die();
        }
        return $this->render('new', ['article' => $article]);
    }

    public static function checkArticleExists($id)
    {
        return Article::find()->id($id)->one() !== null;
    }
}
