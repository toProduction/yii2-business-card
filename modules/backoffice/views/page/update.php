<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $templateList array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div id="page" class="page-update">
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
            'templateList' => $templateList
        ]) ?>
        <div class="clearfix"></div>
    </div>
</div>
<p>&nbsp;</p>
