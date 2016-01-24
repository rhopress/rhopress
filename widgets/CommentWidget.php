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

namespace rhopress\widgets;

/**
 * Description of CommentWidget
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class CommentWidget extends \yii\base\Widget
{

    public $comment;

    public function run()
    {
        return $this->render('comment', ['comment' => $this->comment]);
    }
}
