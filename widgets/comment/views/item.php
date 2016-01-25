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
use rhopress\Module;
use rhopress\widgets\comment\ItemWidget;
use rhopress\widgets\comment\NewWidget;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $comment rhopress\models\Comment */
/* @var $newComment rhopress\models\Comment */
?>
<?= $comment->user->profile->display_name; ?>:&nbsp;
<?= $comment->content; ?>
<?php if ($comment->user->guid == Yii::$app->user->identity->guid) : ?>
    <?= Html::a(Module::t('views/comment', 'Delete'), Url::to(['comment/delete', 'id' => $comment->article->id, 'cid' => $comment->id]), ['data-method' => 'post', 'class' => 'btn btn-danger']); ?>
<?php endif; ?>
<hr/>
<div class="row">
    <div class="col-lg-offset-1">
        <?php
        foreach ($comment->children as $sub) {
            echo ItemWidget::widget(['comment' => $sub]);
        }
        ?>
        <?= NewWidget::widget(['comment' => $newComment]); ?>
    </div>
</div>