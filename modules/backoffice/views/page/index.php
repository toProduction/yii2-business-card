<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page" class="page-index">

    <div class="block">
        <div class="page-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <?php if ($dataProvider->count): ?>
            <?= Html::a(Yii::t('app','New page'), ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            <?php endif;?>
        </div>
        <?php if ($dataProvider->count): ?>
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'options'      => ['class' => 'table-responsive'],
                    'tableOptions' => ['class' => 'table table-hover'],
                    'rowOptions' => function ($model) {
                        $return = [];
                        switch ($model->status) {
                            case "deactive":
                            {
                                $return['class'] = 'danger';
                                break;
                            }
                        }
                        return $return;
                    },
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        [
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->name, ['/backoffice/page/update', 'id' => $model->id]);
                            },
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                        // 'meta_title',
                        // 'meta_keywords',
//                         'meta_description',
                        // 'menu_id',
                    ],
                ]); ?>
            </div>
        <?php else: ?>
            <div class="empty">
                <div class="create col-xs-4 col-xs-offset-4 text-center">
                    <p class="icon"><i class="glyphicon glyphicon-info-sign"></i>
                        <br><?= Yii::t('app', 'You can create your first page')?></p>

                    <p><?= Html::a(Yii::t('app', 'Create page'), ['create'], ['class' => 'btn btn-primary btn-lg']) ?></p>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
