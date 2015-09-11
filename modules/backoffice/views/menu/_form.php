<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'col-xs-12']]); ?>
<div class="input-group">
    <?= Html::activeTextInput($model, 'name', ['class' => 'form-control','placeholder' => Yii::t('app','Menu name, for example: The header menu')]) ?>
    <span class="input-group-btn">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </span>
</div>
<?php ActiveForm::end(); ?>

