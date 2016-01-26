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

namespace rhopress\controllers\article;

use Yii;
use rhopress\controllers\ArticleController;

/**
 * Description of ViewAction
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class ViewAction extends \yii\base\Action
{

    public function run($id)
    {
        $article = ArticleController::getArticle($id);
        $comment = Yii::$app->user->isGuest ? null : $article->createComment();
        return $this->controller->render('view', ['article' => $article, 'newComment' => $comment]);
    }
}
