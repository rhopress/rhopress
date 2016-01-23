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

/* @var $article rhopress\models\Article */
?>
<section id="post-new">
    <div class="box">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($article, 'title') ?>
        <?= $form->field($article, 'content')->textarea(['rows' => 2]) ?> 
        <hr>
        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Add'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('<span class="glyphicon glyphicon-refresh"></span> ' . Yii::t('app', 'Reset'), ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>