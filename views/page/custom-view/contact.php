<?php
/* @var $this yii\web\View */
/* @var $page app\models\Page */

$this->registerMetaTag(['name' => 'description', 'content' => $page->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta_keywords]);
$this->title = (!$page->title ? $page->name : $page->title);
?>
<h1><?= $page->name ?></h1>
<p class="lead"><?= $page->full_text ?></p>
<div class="row">
    <div class="col-xs-6">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2252.03499048867!2d37.80184110000149!3d55.63618139850586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x414ab6b7c8ed618b%3A0x289fbc674ee02b96!2z0JrQsNC_0L7RgtC90Y8gMy3QuSDQutCyLdC7LCDQnNC-0YHQutCy0LA!5e0!3m2!1sru!2sru!4v1438453532151"
            width="100%"
            height="450"
            frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="col-xs-6">
        <?= \app\components\FeedbackWidget::widget()?>
    </div>
</div>
