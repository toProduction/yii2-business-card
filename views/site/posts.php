<?php
/* @var $this yii\web\View */
/* @var $posts app\models\Post */

use yii\helpers\Url;
$this->title = Yii::t('app', 'News');
?>
<div class="page-header">
    <h1><?= $this->title?></h1>
</div>
<div id="posts">
    <?php foreach ($posts as $post):?>
    <div class="media">
        <div class="media-body">
            <h2 class="media-heading"><a href="<?= Url::to(['post', 'id' => $post->id])?>"><?= $post->name?></a></h2>
            <?= $post->description?>
        </div>
    </div>
    <?php endforeach;?>
</div>