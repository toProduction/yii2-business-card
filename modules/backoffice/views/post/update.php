<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Update Post: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div id="post" class="post-update">
    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']); ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <p class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </p>
    <?php endif; ?>
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('app', 'Delete'), [
                'delete',
                'id' => $model->id,
            ], ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']) ?>
        </div>
        <?= $this->render('_form', [
            'model'        => $model,
        ]) ?>
        <div class="clearfix"></div>
    </div>
</div>
<p>&nbsp;</p>