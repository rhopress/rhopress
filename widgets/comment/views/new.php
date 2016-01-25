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
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $comment rhopress\models\Comment */
/* @var $form yii\widgets\ActiveForm */
$route = empty($comment->parent) ? ['comment/new', 'id' => $comment->article->id] : ['comment/review', 'id' => $comment->article->id, 'cid' => $comment->parent->id];
$form = ActiveForm::begin(['action' => Url::to($route)]);
?>
<?= $form->field($comment, 'content', ['template' => "{input}\n{hint}\n{error}"]) ?>
<div class="form-group">
    <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> ' . Module::t('views/comment', 'Review'), ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('<span class="glyphicon glyphicon-refresh"></span> ' . Module::t('views/comment', 'Reset'), ['class' => 'btn btn-danger']) ?>
</div>
<?php ActiveForm::end() ?>