<?php

namespace app\modules\backoffice;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backoffice\controllers';

    public function init()
    {
        parent::init();

        \Yii::$app->view->title = \Yii::t('app', 'Control Panel');
    }
}
