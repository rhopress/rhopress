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
        $result = $user->register();
        if ($result !== true) {
            var_dump($user->errors);
        }
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

    public static function prepareArticle($user)
    {
        return $user->create(Article::className(), ['title' => 'title', 'content' => 'content']);
    }

    /**
     * @depends testNew
     */
    public function testSlugName()
    {
        $user = UserTest::prepareUser('article-tester');
        $article = self::prepareArticle($user);
        $title = '--t-i-t-l-e--';
        $article->title = $title;
        $article->name = '';
        $this->assertTrue($user->register([$article]));
        $this->assertEquals(\yii\helpers\Inflector::slug($title), $article->name);
        $article = Article::find()->name(\yii\helpers\Inflector::slug($title), 'like')->one();
        $this->assertEquals($user->articles[0]->guid, $article->guid);
        $article = Article::find()->name(\yii\helpers\Inflector::slug($title), 'not like')->one();
        $this->assertNull($article);
        $this->assertTrue($user->deregister());
    }
}
