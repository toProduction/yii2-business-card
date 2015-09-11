<?php
/* @var $this yii\web\View */
/* @var $page app\models\Page */

$this->registerMetaTag(['name' => 'description', 'content' => $page->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta_keywords]);
$this->title = (!$page->title ? $page->name : $page->title);
?>
<h1>Custom template</h1>
<h2><?= $page->name ?></h2>

<p><?= $page->full_text ?></p>
