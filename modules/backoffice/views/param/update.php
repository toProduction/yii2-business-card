<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Param */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Setting',
]) . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'id' => $model->key]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="page" class="menu-create">
    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']); ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <p class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </p>
    <?php endif; ?>
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <?= $this->render('_form', [
            'model'        => $model,
        ]) ?>
        <div class="clearfix"></div>
    </div>
</div>
<p>&nbsp;</p>