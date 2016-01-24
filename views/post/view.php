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
use yii\helpers\Html;
use yii\helpers\Url;
use rhopress\widgets\CommentWidget;

/* @var $this yii\web\View */
/* @var $article rhopress\models\Article */
/*
$comment = $article->createComment(['content' => 'comment']);
$comment->save();
$sub = $comment->createComment(['content' => 'sub']);
$sub->save();*/
?>
<section id="post-view">
    <div class="box">
        <h2 style="padding: 0; font-family: Noto-Serif"><?= Html::encode($article->title) ?></h2>
        <br/>
        <div class="entry-content">
            <p style="font-family: Noto-Serif; font-size: 19px; font-weight: 400"><?= Html::encode($article->content) ?></p>
        </div>
        <?php
        if ($comments = $article->getComments()) {
            foreach ($comments as $comment) {
                echo CommentWidget::widget(['comment' => $comment]);
            }
        }
        ?>
        <hr/>
        <?= Html::a(Yii::t('app', 'Delete'), Url::to(['post/delete', 'id' => $article->id]), ['data-method' => 'post', 'class' => 'btn btn-danger']); ?>
    </div>
</section>