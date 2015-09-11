<?php
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backoffice-default-index">
    <div class="col-xs-12">
        <div class="row">
            <div class="block">
                <h2 class="title"><?= Yii::t('app', 'Welcome to the Business Card!'); ?> <br>
                    <small><?= Yii::t('app', 'Open source project on Yii2.'); ?></small>
                </h2>
            </div>
        </div>
    </div>
    <p>&nbsp;</p>

    <div class="block">
        <div class="page-header">
            <h3><?= Yii::t('app','Messages'); ?></h3>
        </div>
        <?php if ($dataProvider->count): ?>
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'options'      => ['class' => 'table-responsive'],
                    'tableOptions' => ['class' => 'table table-hover'],
                    'rowOptions' => function ($model) {
                        $return = [];
                        switch ($model->touch) {
                            case 0:
                            {
                                $return['class'] = 'success';
                                break;
                            }
                        }
                        return $return;
                    },
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        [
                            'attribute' => 'subject',
                            'format'    => 'raw',
                            'value'     => function ($model) {
                                return Html::a($model->subject, ['/backoffice/default/message-view', 'id' => $model->id]);
                            },
                        ],
                        'name:ntext',
                        'body:ntext',
                        'created_at:datetime',
                    ],
                ]); ?>
            </div>
        <?php else: ?>
            <div class="empty">
                <div class="create col-xs-4 col-xs-offset-4 text-center">
                    <p class="icon"><i class="glyphicon glyphicon-info-sign"></i>
                        <br><?= Yii::t('app', 'Not new messages') ?></p>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
