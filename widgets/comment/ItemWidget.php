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

namespace rhopress\widgets\comment;

use rhopress\models\Comment;

/**
 * Description of CommentWidget
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class ItemWidget extends \yii\base\Widget
{

    /**
     * @var Comment comment instance.
     */
    public $comment;

    /**
     * @var Comment comment instance.
     */
    public $newComment;

    public function run()
    {
        return $this->render('item', ['comment' => $this->comment, 'newComment' => \Yii::$app->user->isGuest ? null : ($this->newComment instanceof Comment ? $this->newComment : $this->comment->createComment())]);
    }
}
