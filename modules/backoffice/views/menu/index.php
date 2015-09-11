<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Create menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="menu" class="menu-index">
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('app', 'New menu'), ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php if ($dataProvider->count): ?>
            <div class="col-xs-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options'      => ['class' => 'table-responsive'],
                'tableOptions' => ['class' => 'table table-hover'],
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'attribute'=>'name',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->name, ['/backoffice/menu/update', 'id' => $model->id]);
                        }
                    ],
                    'status',
                    'created_at:datetime',
                    'updated_at:datetime',
                    // 'user_id',
                ],
            ]); ?>
            </div>
        <?php else: ?>
            <div class="empty">
                <div class="create col-xs-4 col-xs-offset-4 text-center">
                    <p class="icon"><i class="glyphicon glyphicon-info-sign"></i>
                        <br><?= Yii::t('app','You can create your first menu')?></p>

                    <p><?= Html::a(Yii::t('app','Create menu'), ['create'], ['class' => 'btn btn-primary btn-lg']) ?></p>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
