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
 * Description of CommentQuery
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class CommentQuery extends \vistart\Models\queries\BaseBlameableQuery
{

    public function parentComment($guid = [])
    {
        $model = $this->noInitModel;
        if (empty($guid)) {
            return $this->andWhere([$model->parentAttribute => '']);
        }
        return $this->andWhere([$model->parentAttribute => $guid]);
    }

    public function article($guid)
    {
        return $this->andWhere(['article_guid' => $guid]);
    }
}
