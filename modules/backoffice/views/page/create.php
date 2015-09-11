<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $templateList array */

$this->title = Yii::t('app', 'New page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page" class="menu-create">
    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']); ?>
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <?= $this->render('_form', [
            'model'        => $model,
            'templateList' => $templateList,
        ]) ?>
        <div class="clearfix"></div>
    </div>
</div>
<p>&nbsp;</p>
