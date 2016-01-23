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

use rhopress\models\Email;

/**
 * Description of EmailTest
 *
 * @author vistart <i@vistart.name>
 */
class EmailTest extends TestCase
{

    public function testNew()
    {
        $email = new Email(['email' => 'dev@rho.press']);
        $this->assertInstanceOf(Email::className(), $email);
    }
}
