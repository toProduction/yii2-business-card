<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $menu app\models\Menu */
/* @var $menuItem app\models\MenuItem */
/* @var $model app\models\MenuItem */
/* @var $modelPages [] */

$this->title = $menu->name .
    " | " . (!$model->isNewRecord ? Yii::t('app', 'Edit submenu') : Yii::t('app', 'Create submenu'));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $menu->name, 'url' => ['view', 'id' => $menu->id]];
$this->params['breadcrumbs'][] = ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Edit'));
?>
<div id="menu" class="menu-create">
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('app', 'Delete'), [
                'sub-menu-delete',
                'id' => $model->id,
                'menu_id' => $menu->id,
            ], ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']) ?>
        </div>
        <?= $this->render('_sub_menu_form', ['model' => $model, 'modelPages' => $modelPages]) ?>
        <div class="clearfix"></div>
    </div>
</div>
