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
 * Description of Comment
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class Comment extends Post
{

    public $updatedAtAttribute = false;
    public $contentAttributeRule = ['string', 'max' => '1024'];
    public $parentAttribute = 'parent_guid';
    public $updatedByAttribute = false;
    public $idAttributeLength = 4;
    public $idAttributeType = 0;

    public static function tableName()
    {
        return '{{%comment}}';
    }

    public function init()
    {
        $this->queryClass = CommentQuery::className();
        parent::init();
    }

    public function rules()
    {
        $rules = [
            ['article_guid', 'required'],
            ['article_guid', 'string', 'max' => 36],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function createComment($config = [])
    {
        if (!isset($config['article_guid'])) {
            $config['article_guid'] = $this->article_guid;
        }
        return $this->bear($config);
    }
}
