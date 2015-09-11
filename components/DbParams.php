<?php
/**
 * Created by PhpStorm.
 * User: inginer
 * Date: 02.08.15
 * Time: 15:23
 */

namespace app\components;


use app\models\Param;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class DbParams
 * @package app\components
 * @author Ruslan Madatov <ruslanmadatov@yandex.ru>
 */
class DbParams extends Component
{
    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init ()
    {
        \Yii::$app->params['dbParams'] = ArrayHelper::merge(
            \Yii::$app->params['dbParams'],
            ArrayHelper::map(Param::find()->asArray()->all(), 'key', 'value')
        );
    }
}