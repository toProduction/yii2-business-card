<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = Yii::t('app', 'Create menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="menu" class="menu-create">
    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']); ?>
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <?= $this->render('_form', ['model' => $model]) ?>
        <p>&nbsp;</p>
        <div class="clearfix"></div>
    </div>
</div>
