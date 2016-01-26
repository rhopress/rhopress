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
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use rhopress\Module;

/* @var $article rhopress\models\Article */
?>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($article, 'title', ['template' => "{input}\n{hint}\n{error}"]) ?>
        <?= $form->field($article, 'content', ['template' => "{input}\n{hint}\n{error}"])->textarea(['rows' => 2]) ?> 
        <hr>
        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> ' . Module::t('views/article', 'Publish'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('<span class="glyphicon glyphicon-refresh"></span> ' . Module::t('views/article', 'Reset'), ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>