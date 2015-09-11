<?php
/* @var $this yii\web\View */
/* @var $post app\models\Post */
$this->title = (!$post->title ? $post->name : $post->title);
?>
<div class="page-header">
    <h1><?= $this->title?></h1>
</div>
<?= $post->body?>