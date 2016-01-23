<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://lite.rho.press/
 * @copyright Copyright (c) 2016 vistart
 * @license https://lite.rho.press/license/
 */

namespace rhopress\models;

use vistart\Models\models\BaseUserModel;
use Yii;

/**
 * User Model
 *
 * @property string $username
 * @property-read Profile $profile
 * @property-read Email[] $emails
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class User extends BaseUserModel
{

    /**
     * @var integer string
     */
    public $idAttributeType = 0;

    /**
     * @var integer max length
     */
    public $idAttributeLength = 32;

    /**
     * @var boolean ID assigned by user.
     */
    public $idPreassigned = true;

    public function getUsername()
    {
        $idAttribute = $this->idAttribute;
        return $this->$idAttribute;
    }

    public function setUsername($username)
    {
        $idAttribute = $this->idAttribute;
        return $this->$idAttribute = $username;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guid' => Yii::t('app', 'User\'s Universally Unique IDentifier'),
            'id' => Yii::t('app', 'IDentifier No.'),
            'pass_hash' => Yii::t('app', 'User\'s Password Hash'),
            'ip_1' => Yii::t('app', 'ip_1'),
            'ip_2' => Yii::t('app', 'ip_2'),
            'ip_3' => Yii::t('app', 'ip_3'),
            'ip_4' => Yii::t('app', 'ip_4'),
            'ip_type' => Yii::t('app', 'IP Address Type'),
            'create_time' => Yii::t('app', 'Registration Time'),
            'update_time' => Yii::t('app', 'Last Update Time'),
            'auth_key' => Yii::t('app', 'Authentication Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'status' => Yii::t('app', 'User Status'),
            'source' => Yii::t('app', 'User Source'),
        ];
    }

    public function getProfile()
    {
        $profile = Profile::buildNoInitModel();
        return $this->hasOne(Profile::className(), [$profile->createdByAttribute => $this->guidAttribute])->inverseOf('user');
    }

    public function getEmails()
    {
        $email = Email::buildNoInitModel();
        return $this->hasMany(Email::className(), [$email->createdByAttribute => $this->guidAttribute])->inverseOf('user');
    }
}
