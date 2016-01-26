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

use Yii;
use yii\helpers\Inflector;
use rhopress\Module;

/**
 * Description of Article
 *
 * @property string $name
 * @property integer $status
 * @property integer $comment_status
 * @property string $title
 * @property-read Comment[] $comments
 * @property-read Comment[] $childComments
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
    
    /**
     * @var array All reserved names should be avoided for article alias.
     */
    public static $reservedNames = [
        'new',
        'login',
        'logout',
        'reg',
        'users',
    ];

    public function init()
    {
        $this->queryClass = ArticleQuery::className();
        $this->on(static::EVENT_BEFORE_VALIDATE, [$this, 'onSlugName']);
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['title', 'name'], 'required'],
            [['name'], 'unique'],
            [['title', 'name'], 'trim'],
            [['title', 'name'], 'string', 'max' => 255],
            [['status', 'comment_status'], 'default', 'value' => 0],
            ['status', 'in', 'range' => array_keys(static::$statuses)],
            ['comment_status', 'in', 'range' => array_keys(static::$commentStatuses)],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributeLabels()
    {
        return [
            'title' => static::t('Title'),
            'name' => static::t('Article alias'),
            'status' => static::t('Article status'),
            'comment_status' => static::t('Comment status'),
            'content' => Module::t('models', 'Content'),
            'create_time' => Module::t('models', 'Created At'),
            'update_time' => Module::t('models', 'Last Updated At'),
        ];
    }

    /**
     * 
     * @param \yii\base\ModelEvent $event
     */
    public function onSlugName($event)
    {
        $sender = $event->sender;
        if (empty($sender->name) && !empty($sender->title)) {
            $sender->name = static::generateNewSlugName($sender->title);
        }
    }

    /**
     * Generate new slug name according to article title or custom name. If
     * provided string existed, it will attach next order automatically.
     * @param string $title article title or custom name.
     * @return string new slug name.
     */
    public static function generateNewSlugName($title)
    {
        $counter = 0;
        $suffix = '';
        do {
            $name = Inflector::slug($title);
            if ($counter) {
                $suffix = '-' . $counter;
            }
            $name .= $suffix;
            $counter++;
        } while (static::checkSlugNameExists($name));
        return $name;
    }

    /**
     * Check whether slug name exists.
     * @param string $name slug name to be checked.
     * @return boolean Whether the slug name exists.
     */
    public static function checkSlugNameExists($name)
    {
        return static::find()->name($name)->exists() || in_array($name, static::$reservedNames);
    }

    /**
     * Create new comment.
     * @param array $config
     * @return Comment
     */
    public function createComment($config = [])
    {
        $model = Comment::buildNoInitModel();
        if (!isset($config['class'])) {
            $config['class'] = Comment::className();
        }
        if (!isset($config[$model->parentAttribute])) {
            $config[$model->parentAttribute] = '';
        }
        if (!isset($config['article_guid'])) {
            $config['article_guid'] = $this->guid;
        }
        return Yii::createObject($config);
    }

    /**
     * Get all comments belong to article.
     * @return \rhopress\models\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_guid' => $this->guidAttribute])->inverseOf('article');
    }

    /**
     * Get all child comments, not grandchild ones.
     * @return \rhopress\models\CommentQuery
     */
    public function getChildComments()
    {
        return $this->getComments()->parentComment();
    }

    /**
     * @inheritdoc
     */
    public static function t($message, $params = [], $language = null)
    {
        return Module::t('models/article', $message, $params, $language);
    }
    
    /**
     * Friendly to IDE.
     * @return ArticleQuery
     */
    public static function find() {
        return parent::find();
    }
}
