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
/* @var $model rhopress\models\User */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="user">
    <?php $profile = $model->profile ?>
    <?php if ($profile): ?>
        <?= Html::encode($profile->display_name) ?>
    <?php endif; ?>
</div>