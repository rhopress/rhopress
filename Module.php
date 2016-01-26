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

namespace rhopress;

/**
 * Description of Module
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

    public $controllerNamespace = 'rhopress\controllers';

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $rules = [
                '' => $this->id . '/article/index',
                '<id:\d+>' => $this->id . '/article/view',
                'new' => $this->id . '/article/new',
                '<id:\d+>/delete' => $this->id . '/article/delete',
                '<id:\d+>/comment' => $this->id . '/comment/new',
                '<id:\d+>/comments' => $this->id . '/comment/list',
                '<id:\d+>/comment/<cid:\w+>/review' => $this->id . '/comment/review',
                '<id:\d+>/comment/<cid:\w+>/delete' => $this->id . '/comment/delete',
                'users' => $this->id . '/user/index',
                '<id:\w+(-\w+)*>' => $this->id . '/article/view-by-name',
            ];
            $app->getUrlManager()->addRules($rules);

            $app->i18n->translations['rhopress*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => '@rhopress/messages',
            ];
        }
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('rhopress/' . $category, $message, $params, $language);
    }
}
