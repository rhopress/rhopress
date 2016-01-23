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
 * Description of Email
 *
 * @property boolean $enable_login
 * @property integer $permission
 * 
 * @property string $email
 * @property-read User $user
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class Email extends \vistart\Models\models\BaseBlameableModel
{

    public $enableIP = false;
    public $contentAttributeRule = 'email';
    public $confirmationAttribute = false;

    const PERMISSION_PUBLIC = 'public';
    const PERMISSION_PRIVATE = 'private';

    public static $permissions = [
        0 => self::PERMISSION_PRIVATE,
        1 => self::PERMISSION_PUBLIC,
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email}}';
    }

    public function getEmail()
    {
        return $this->getContent();
    }

    public function setEmail($email)
    {
        return $this->setContent($email);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            ['enable_login', 'boolean'],
            ['permission', 'in', 'range' => array_keys(static::$permissions)],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guid' => Yii::t('app', 'Guid'),
            'user_guid' => Yii::t('app', 'User Guid'),
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'enable_login' => Yii::t('app', 'Enable Login'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'permission' => Yii::t('app', 'Permission'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $user = User::buildNoInitModel();
        return $this->hasOne(User::className(), [$user->guidAttribute => $this->createdByAttribute]);
    }
}
