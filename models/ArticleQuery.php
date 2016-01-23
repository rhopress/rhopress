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

namespace rhopress\models;

/**
 * Description of ArticleQuery
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class ArticleQuery extends \vistart\Models\queries\BaseBlameableQuery
{

    public function title($title, $like = false)
    {
        return $this->likeCondition($title, 'title', $like);
    }

    public function name($name, $like = false)
    {
        return $this->likeCondition($name, 'name', $like);
    }
}
