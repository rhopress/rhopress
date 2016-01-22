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

namespace rhopress\tests;

use rhopress\models\User;

/**
 * Description of UserTest
 *
 * @author vistart <i@vistart.name>
 */
class UserTest extends TestCase
{

    public function testNew()
    {
        $user = new User();
        $this->assertNotNull($user);
        $this->assertInstanceOf(User::className(), $user);
        $this->assertEmpty($user->id);
    }

    public function testRegister()
    {
        $user = new User();
        $result = $user->register();
        if ($result === true) {
            $this->fail(); // ID not assigned.
        } else {
            $this->assertTrue(true);
        }
        $user = new User(['id' => 'rhopress', 'password' => '123456']);
        $result = $user->register();
        if ($result === true) {
            $this->assertTrue($result);
        } else {
            var_dump($user->rules());
            var_dump($$user->errors);
            $this->fail();
        }
        
        $user = new User(['id' => 'rhopress', 'password' => '123456']);
        $result = $user->register();
        if ($result === true) {
            $this->fail(); // ID existed.
        } else {
            $this->assertTrue(true);
        }
        
        $user = User::find()->id('rhopress')->one();
        $this->assertNotNull($user);
        $this->assertInstanceOf(User::className(), $user);
        $this->assertTrue($user->deregister());
    }
}
