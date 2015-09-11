<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Param */

$this->title = Yii::t('app', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="setting" class="setting-create">
    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']); ?>
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
