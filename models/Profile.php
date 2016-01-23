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
 * Description of Profile
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property string $website
 * @property string $icon
 * @property string $individual_sign
 * @property-read User $user
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class Profile extends \vistart\Models\models\BaseBlameableModel
{

    public $guidAttribute = false;
    public $idAttribute = false;
    public $createdByAttribute = 'guid';
    public $updatedByAttribute = false;
    public $createdAtAttribute = false;
    public $updatedAtAttribute = false;
    public $contentAttribute = 'nickname';
    public $contentAttributeRule = ['string', 'max' => 255];
    public $enableIP = false;
    public $descriptionAttribute = 'individual_sign';

    public function rules()
    {
        $rules = [
            ['website', 'url'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'default', 'value' => ''],
            ['icon', 'string', 'max' => 36],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function getDescriptionRules()
    {
        return [
            [$this->descriptionAttribute, 'string', 'max' => 65535],
            [$this->descriptionAttribute, 'default', 'value' => ''],
        ];
    }

    /**
     * Disable checking id and guid attributes;
     * @return boolean
     */
    public function checkAttributes()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guid' => Yii::t('app', 'Guid'),
            'nickname' => Yii::t('app', 'Nickname'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'icon' => Yii::t('app', 'Icon'),
            'display_name' => Yii::t('app', 'Display Name'),
            'website' => Yii::t('app', 'Website'),
            'individual_sign' => Yii::t('app', 'Individual Sign'),
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
