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
 * Description of Article
 *
 * @property string $name
 * @property integer $status
 * @property integer $comment_status
 * @property string $title
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class Article extends Post
{

    public static function tableName()
    {
        return '{{%article}}';
    }

    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';

    public static $statuses = [
        0 => self::STATUS_PUBLISHED,
        1 => self::STATUS_DRAFT,
    ];

    const COMMENT_OPEN = 'open';
    const COMMENT_CLOSE = 'close';

    public static $commentStatuses = [
        0 => self::COMMENT_OPEN,
        1 => self::COMMENT_CLOSE,
    ];

    public function init()
    {
        $this->queryClass = ArticleQuery::className();
        parent::init();
    }

    public function rules()
    {
        $rules = [
            [['name', 'title'], 'required'],
            [['name', 'title'], 'string', 'max' => 255],
            [['status', 'comment_status'], 'default', 'value' => 0],
            ['status', 'in', 'range' => array_keys(static::$statuses)],
            ['comment_status', 'in', 'range' => array_keys(static::$commentStatuses)],
        ];
        return array_merge(parent::rules(), $rules);
    }
}
