<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\BackOfficeAsset;
use app\models\Feedback;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

BackOfficeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::to(['/backoffice']) ?>">BACKOFFICE</a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--                    <form class="navbar-form navbar-left hidden-sm" role="search">-->
<!--                        <div class="input-group">-->
<!--                            <input type="text" class="form-control" placeholder="Search for...">-->
<!--                            <span class="input-group-btn">-->
<!--                                <button class="btn btn-default" type="button">Go!</button>-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </form>-->
                    <?= Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'encodeLabels' => false,
                        'items'   => [
                            [
                                'label' => Yii::t('app', 'Messages') . ' &nbsp; ' . Html::tag('span', Feedback::find()->where(['touch' => 0])->count(), ['class' => 'badge']),
                                'format' => 'html',
                                'linkOptions' => ['class' => 'link-color-white'],
                                'url'   => ['/backoffice'],
                            ],
                            [
                                'label' => Yii::t('app', 'Go to site'),
                                'linkOptions' => ['class' => 'link-color-white'],
                                'url'   => '/',
                            ],
                            [
                                'label'       => Yii::$app->user->identity->username,
                                'linkOptions' => ['class' => 'link-color-white'],
                                'items'       => [
                                    ['label'       => Yii::t('app', 'Logout'),
                                     'url'         => ['/site/logout'],
                                     'linkOptions' => ['data-method' => 'post']
                                    ]
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container wrap">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="list-group">
                <div class="profile">
                    <p class="text-center">
                        <img src="/backoffice/img/ava.png" class="profile-ava img-circle img-responsive">
                    </p>

                    <p class="text-center"><?= Yii::$app->user->identity->username?></p>
                </div>
                <a href="<?= Url::to(['/backoffice/menu'])?>" class="list-group-item"><?= Yii::t('app', 'Menu')?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                <a href="<?= Url::to(['/backoffice/page'])?>" class="list-group-item"><?= Yii::t('app', 'Pages')?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                <a href="<?= Url::to(['/backoffice/post'])?>" class="list-group-item"><?= Yii::t('app', 'Posts')?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                <a href="<?= Url::to(['/backoffice/param'])?>" class="list-group-item"><?= Yii::t('app', 'Settings')?> <i class="glyphicon glyphicon-chevron-right"></i></a>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 content">
            <div class="wrap">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['dbParams']['companyName']?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
