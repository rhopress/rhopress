<?php

/*
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
                '' => $this->id . '/post/index',
                '<id:\d+>' => $this->id . '/post/view',
                'new' => $this->id . '/post/new',
                '<id:\d+>/comment' => $this->id . '/comment/new',
                '<id:\d+>/comments' => $this->id . '/comment/list',
                '<id:\w+>' => $this->id . '/post/viewbyname',
            ];
            $app->getUrlManager()->addRules($rules);
        }
    }
}
