<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="post" class="post-index">
    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?php if ($dataProvider->count): ?>
                <?= Html::a(Yii::t('app', 'Add post'), ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            <?php endif; ?>
        </div>
        <?php if ($dataProvider->count): ?>
        <div class="col-xs-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options'      => ['class' => 'table-responsive'],
                'tableOptions' => ['class' => 'table table-hover'],
                'rowOptions'   => function ($model) {
                    $return = [];
                    switch ($model->status) {
                        case "deactive": {
                            $return['class'] = 'danger';
                            break;
                        }
                    }

                    return $return;
                },
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a($model->name, ['/backoffice/post/update', 'id' => $model->id]);
                        },
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    //'meta_keywords',
                    //'alias',
                    //'description:ntext',
                    //'meta_description',
                ],
            ]); ?>
            <?php else: ?>
                <div class="empty">
                    <div class="create col-xs-4 col-xs-offset-4 text-center">
                        <p class="icon"><i class="glyphicon glyphicon-info-sign"></i>
                            <br><?= Yii::t('app', 'You can create your first post') ?></p>

                        <p><?= Html::a(Yii::t('app', 'Add post'), ['create'], ['class' => 'btn btn-primary btn-lg']) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
