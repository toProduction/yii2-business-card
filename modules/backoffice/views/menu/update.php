<?php

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $modelMenuItem app\models\MenuItem */
/* @var $modelPages [] */

use app\assets\JsTreeAsset;
use app\helpers\MenuHelper;
use app\models\MenuItem;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

JsTreeAsset::register($this);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$menuItems = MenuItem::getPageWithName(['menu_id' => $model->id]);
?>
<div id="menu" class="menu-update">
    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']); ?>
    <?= Html::errorSummary($modelMenuItem, ['class' => 'alert alert-danger']); ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <p class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </p>
    <?php endif; ?>
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('app', 'Delete'), ['/backoffice/menu/delete', 'id' => $model->id], [
                'data-method' => 'post',
                'class'       => 'btn btn-danger btn-sm'
            ]) ?>
            <?= Html::a(Yii::t('app', 'New item'), ['#'], [
                'data-toggle' => 'modal',
                'data-target' => '#lunchModal',
                'class'       => 'btn btn-primary btn-sm'
            ]) ?>
        </div>
        <?= $this->render('_form', ['model' => $model]) ?>
        <p>&nbsp;</p>

        <div class="clearfix"></div>
        <div id="jstree" class="col-xs-12 mainList">
            <?= \yii\widgets\Menu::widget([
                'options'         => ['class' => 'list-unstyled mainList'],
                'submenuTemplate' => '<ul class="list-unstyled sub-menu-list">{items}</ul>',
                'linkTemplate'    => '<a href="{url}">{label}</a>',
                'items'           => MenuHelper::getMenuById($model->id, 'edit'),
            ]); ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="modal fade" id="lunchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'New menu item') ?></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li role="presentation" class="active"><a href="#pages-link" aria-controls="pages-link"
                                                                      role="tab"
                                                                      data-toggle="tab"><?= Yii::t('app', 'Pages') ?></a>
                            </li>
                            <li role="presentation"><a href="#link-link" aria-controls="link-link"
                                                       role="tab" data-toggle="tab"><?= Yii::t('app', 'Links') ?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="link-link">
                                <p>&nbsp;</p>
                                <?php $form = ActiveForm::begin([]); ?>
                                <div class="col-xs-12">
                                    <?= $form->field($modelMenuItem, 'name')->label(Yii::t('app', 'Title')) ?>
                                </div>
                                <div class="col-xs-12">
                                    <?= $form->field($modelMenuItem, 'url')->textInput([
                                        'placeholder' => Yii::t('app', 'Link menu, for example: {url}', ['url' => 'http://site.com/post/about.html']),
                                    ]) ?>
                                </div>
                                <div class="col-xs-12">
                                    <?= $form->field($modelMenuItem, 'parent_id')->textInput([
                                        'class' => 'form-control',
                                    ])->dropDownList($menuItems, ['prompt' => Yii::t('app', 'Without parent')]); ?>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                                    <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Save') ?></button>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane active" id="pages-link">
                                <p>&nbsp;</p>
                                <?php $form = ActiveForm::begin([]); ?>
                                <div class="col-xs-12">
                                    <?= $form->field($modelMenuItem, 'name')->label(Yii::t('app', 'Title')) ?>
                                </div>
                                <div class="col-xs-12">
                                    <?= $form->field($modelMenuItem, 'page_id')->dropDownList($modelPages, ['prompt' => Yii::t('app', 'Select page')]) ?>
                                </div>
                                <div class="col-xs-12">
                                    <?= $form->field($modelMenuItem, 'parent_id')->textInput([
                                        'class' => 'form-control',
                                    ])->dropDownList($menuItems, ['prompt' => Yii::t('app', 'Without parent')]); ?>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                                    <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Save') ?></button>
                                </div>
                                <?php $form = ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="lunchModalJsTree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'New menu item') ?></h4>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>