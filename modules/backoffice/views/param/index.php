<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="setting" class="setting-index">
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?php if ($dataProvider->count): ?>
                <?= Html::a(Yii::t('app', 'Create Setting'), ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            <?php endif; ?>
        </div>
        <?php if ($dataProvider->count): ?>
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'options'      => ['class' => 'table-responsive'],
                    'tableOptions' => ['class' => 'table table-hover'],
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'key',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->key, ['/backoffice/param/update', 'id' => $model->key]);
                            },
                        ],
                        'value:ntext',
                        'comment',
                    ],
                ]); ?>
            </div>
        <?php else: ?>
            <div class="empty">
                <div class="create col-xs-4 col-xs-offset-4 text-center">
                    <p class="icon"><i class="glyphicon glyphicon-info-sign"></i>
                        <br><?= Yii::t('app', 'You can create settings for the site')?></p>

                    <p><?= Html::a(Yii::t('app', 'Create Setting'), ['create'], ['class' => 'btn btn-primary']) ?></p>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
