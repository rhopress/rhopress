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

use rhopress\models\Article;

/**
 * Description of ArticleTest
 *
 * @author vistart <i@vistart.name>
 */
class ArticleTest extends TestCase
{

    public function testNew()
    {
        $user = UserTest::prepareUser('article-tester');
        $this->assertTrue($user->register());
        $article = $user->create(Article::className(), ['content' => 'Yii 2 rhopress published a new article.', 'title' => 'Hello World!', 'name' => 'hello-world']);
        $result = $article->save();
        if ($result === true) {
            $this->assertTrue($result);
        } else {
            var_dump($article->errors);
            $this->fail();
        }
        $article = $user->articles[0];
        $this->assertEquals($user, $article->user);
        $this->assertTrue($user->deregister());
    }
}
