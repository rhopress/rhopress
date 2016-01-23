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
use rhopress\models\User;

/**
 * Description of LoginForm
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class LoginForm extends \yii\base\Model
{

    public $username;
    public $password;
    public $rememberMe = true;
    private $user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'max' => 255, 'min' => 3],
            ['password', 'string', 'max' => 32],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect account or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $user = $this->getUser();
        if ($this->validate()) {
            return Yii::$app->user->login($user, $this->rememberMe ? 60 * 5 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->user === false) {
            $this->user = $this->findIdentity($this->username);
        }

        return $this->user;
    }

    const ACCOUNT_TYPE_INVALID = 0;
    const ACCOUNT_TYPE_STRING = 1;
    const ACCOUNT_TYPE_EMAIL = 2;

    private function findIdentity($username)
    {
        switch ($this->judgeUsernameType($username)) {
            case static::ACCOUNT_TYPE_STRING:
                return User::findIdentity($username);
            case static::ACCOUNT_TYPE_EMAIL:
                return User::findIdentityByEmail($username);
            default:
                throw new \yii\base\NotSupportedException('Not recognized account type.');
        }
    }

    private function judgeUsernameType($username)
    {
        $emailValidator = new \yii\validators\EmailValidator();
        if ($emailValidator->validate($username)) {
            return static::ACCOUNT_TYPE_EMAIL;
        }
        if (is_string($username) && strlen($username) >= 3 && strlen($username) < 32) {
            return static::ACCOUNT_TYPE_STRING;
        }
        return static::ACCOUNT_TYPE_INVALID;
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember Me'),
        ];
    }
}
