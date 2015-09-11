<?php
/* @var $this yii\web\View */
/* @var $page app\models\Page */

$this->registerMetaTag(['name' => 'description', 'content' => $page->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta_keywords]);
$this->title = (!$page->title ? $page->name : $page->title);
?>
<div class="page-header">
    <h1><?= $page->name ?></h1>
</div>

<p><?= $page->full_text ?></p>