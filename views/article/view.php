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
use rhopress\Module;
use rhopress\widgets\comment\ItemWidget;
use rhopress\widgets\comment\NewWidget;

/* @var $this yii\web\View */
/* @var $article rhopress\models\Article */
/* @var $newComment rhopress\models\Comment */
$formatter = Yii::$app->formatter;
?>
        <h2 style="padding: 0; font-family: Noto Serif; margin-bottom: 12px"><?= Html::encode($article->title) ?></h2>
        <br/>
        <?php
        $createdAtAttribute = $article->createdAtAttribute;
        echo $article->user->profile->display_name . ' ' . Module::t('views/article', 'Published At') . ' ' . $formatter->asDatetime($article->$createdAtAttribute, 'php:Y F d, l, H:i:s');
        ?>
        <?php if (!Yii::$app->user->isGuest && $article->user->guid == Yii::$app->user->identity->guid) : ?>&nbsp;
        <?= Html::a(Module::t('views/article', 'Delete'), Url::to(['article/delete', 'id' => $article->id]), ['data-method' => 'post', 'class' => 'btn btn-danger btn-sm']); ?>
        <?php endif; ?>
        <hr/>

        <div class="entry-content">
            <p style="font-family: Noto-Serif; font-size: 19px; font-weight: 400"><?= Html::encode($article->content) ?></p>
        </div>
        <?php if ($comments = $article->childComments): ?>
            <br/>
            <?php
            foreach ($comments as $comment) {
                echo ItemWidget::widget(['comment' => $comment]);
            }
            ?>
        <?php endif; ?>
        <hr/>
        <?php if ($newComment): ?>
        <?= NewWidget::widget(['comment' => $newComment]) ?>
        <?php endif; ?>