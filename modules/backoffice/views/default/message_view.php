<?php
use yii\helpers\Html;
/**
 * @var $model app\models\Feedback
 * @var $this yii\web\View
 * */
?>
<div class="default-message-view">
    <div class="block">
        <div class="page-header">
            <h3><?= $model->subject?> <small><b><?= $model->name?></b> &lt;<?= $model->email?>&gt; </small></h3>
            <?= Html::a(Yii::t('app', 'Delete'), ['message-delete', 'id' => $model->id],['class' => 'btn btn-danger btn-sm', 'data-method' => 'post'])?>
        </div>
        <div class="col-xs-12">
            <p><?= $model->body?></p>
            <p>&nbsp;</p>
            <p><?= Yii::$app->formatter->asDatetime($model->created_at)?></p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>