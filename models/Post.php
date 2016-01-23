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
 * Description of Post
 *
 * @property-read User $user
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
abstract class Post extends \vistart\Models\models\BaseBlameableModel
{

    public $idAttributeLength = 8;
    public $idAttributeType = 1;
    public $contentAttributeRule = ['string', 'max' => 65535];

    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $user = User::buildNoInitModel();
        return $this->hasOne(User::className(), [$user->guidAttribute => $this->createdByAttribute]);
    }
}
