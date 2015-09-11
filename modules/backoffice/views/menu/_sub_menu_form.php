<?php

use app\models\MenuItem;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuItem */
/* @var $menu app\models\Menu */
/* @var $modelPages [] */

$parentItems = MenuItem::getPageWithName(['status' => 'active', 'menu_id' => $model->menu_id]);
if (!$model->isNewRecord) {
    unset($parentItems[ $model->id ]);
}
?>
<div>
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li role="presentation" class="<?= $model->page_id ? 'active' : '' ?>"><a href="#sub-pages-link"
                                                                                  aria-controls="sub-pages-link"
                                                                                  role="tab"
                                                                                  data-toggle="tab"><?= Yii::t('app', 'Pages'); ?></a>
        </li>
        <li role="presentation" class="<?= !$model->page_id ? 'active' : '' ?>"><a href="#sub-link-link"
                                                                                   aria-controls="sub-link-link"
                                                                                   role="tab"
                                                                                   data-toggle="tab"><?= Yii::t('app', 'Links'); ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?= !$model->page_id ? 'active' : '' ?>" id="sub-link-link">
            <p>&nbsp;</p>
            <?php $form = ActiveForm::begin([]); ?>
            <div class="col-xs-12">
                <?= $form->field($model, 'name')->label(Yii::t('app', 'Title')) ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($model, 'url')->textInput([
                    'placeholder' => Yii::t('app', 'Link menu, for example: {url}', ['url' => 'http://site.com/post/about.html']),
                ]) ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($model, 'parent_id')->textInput([
                    'class' => 'form-control',
                ])->dropDownList($parentItems, ['prompt' => Yii::t('app', 'Without parent')])->label(Yii::t('app', 'Parent')); ?>
            </div>
            <div class="col-xs-6">
                <?= Html::a(Yii::t('app', 'Delete'), [
                    'sub-menu-delete',
                    'id'      => $model->id,
                    'menu_id' => $menu->id,
                ], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
            </div>
            <div class="col-xs-6 text-right">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Save') ?></button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div role="tabpanel" class="tab-pane  <?= $model->page_id ? 'active' : '' ?>" id="sub-pages-link">
            <p>&nbsp;</p>
            <?php $form = ActiveForm::begin([]); ?>
            <div class="col-xs-12">
                <?= $form->field($model, 'name')->label(Yii::t('app', 'Title')) ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($model, 'page_id')->dropDownList($modelPages, ['prompt' => Yii::t('app', 'Select page')]) ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($model, 'parent_id')->textInput([
                    'class' => 'form-control',
                ])->dropDownList($parentItems, ['prompt' => Yii::t('app', 'Without parent')])->label(Yii::t('app', 'Parent')); ?>
            </div>
            <div class="col-xs-6">
                <?= Html::a(Yii::t('app', 'Delete'), [
                    'sub-menu-delete',
                    'id'      => $model->id,
                    'menu_id' => $menu->id,
                ], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
            </div>
            <div class="col-xs-6 text-right">
            <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Save') ?></button>
            </div>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>