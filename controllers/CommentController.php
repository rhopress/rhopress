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
use rhopress\models\Comment;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Description of CommentController
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class CommentController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['new', 'review', 'delete'],
                'rules' => [
                    [
                        'actions' => ['new', 'review', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'new' => ['post'],
                    'delete' => ['post'],
                    'review' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 
     * @param integer|string $id Article id
     * @return type
     */
    public function actionNew($id)
    {
        $comment = ArticleController::getArticle($id)->createComment();
        $comment->content = Yii::$app->request->post($comment->formName())[$comment->contentAttribute];
        if (!$comment->save()) {
            
        }
        return $this->redirect(['article/view', 'id' => $id]);
    }

    /**
     * 
     * @param integer|string $id Article id
     * @param string $cid comment id among article's whole comments.
     */
    public function actionDelete($id, $cid)
    {
        $comment = static::getComment($id, $cid);
        if ($comment->user->guid != Yii::$app->user->identity->guid) {
            throw new \yii\web\ForbiddenHttpException('Delete Denied.');
        }
        if (static::getComment($id, $cid)->delete()) {
            
        }
        return $this->redirect(['article/view', 'id' => $id]);
    }

    public function actionReview($id, $cid = null)
    {
        if (empty($cid)) {
            return $this->actionNew($id);
        }
        $comment = static::getComment($id, $cid);
        $newComment = $comment->createComment();
        $newComment->content = Yii::$app->request->post($comment->formName())[$comment->contentAttribute];
        if (!$newComment->save()) {
            
        }
        return $this->redirect(['article/view', 'id' => $id]);
    }

    /**
     * 
     * @param integer|string $id Article id
     * @param string $cid comment id among article's whole comments.
     * @param boolean $throwExceptionIfNull
     * @return Comment
     * @throws \yii\web\NotFoundHttpException
     */
    public static function getComment($id, $cid, $throwExceptionIfNull = true)
    {
        $article = ArticleController::getArticle($id);
        $comment = Comment::find()->article($article->guid)->id($cid)->one();
        if ($throwExceptionIfNull && !$comment) {
            throw new \yii\web\NotFoundHttpException(static::t('Comment Not Found.'));
        }
        return $comment;
    }

    public static function t($message, $params = [], $language = null)
    {
        return \rhopress\Module::t('controllers/comment', $message, $params, $language);
    }
}
