<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\helpers\MenuHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['dbParams']['companyName'],
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items'   => MenuHelper::getMenuById(1, 'view', [
            [
                'label' => 'Backoffice',
                'url'   => ['/backoffice']
            ]
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="row hidden-xs hidden-sm">
            <div class="col-xs-5">
                <?= \yii\widgets\Menu::widget(['items' => MenuHelper::getMenuById(2, 'view'),'options' => ['class' => 'list-unstyled footer-menu']])?>
            </div>
            <div class="col-xs-3 text-center">
                <ul class="list-unstyled text-left">
                    <li>Lorem Ipsum is simply dummy</li>
                    <li>Lorem Ipsum is simply dummy</li>
                    <li>Lorem Ipsum is simply dummy</li>
                    <li>Lorem Ipsum is simply dummy</li>
                </ul>
            </div>
            <div class="col-xs-4 text-right">
                <a href="#"><img src="/img/twitter.png" height="40"></a>
                <a href="#"><img src="/img/fb.png" height="40"></a>
                <a href="#"><img src="/img/vk.png" height="40"></a>
                <a href="#"><img src="/img/g+.png" height="40"></a>
            </div>
        </div>
        <p class="text-center"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
