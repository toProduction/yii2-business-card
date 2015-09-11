<?php
/**
 * Created by PhpStorm.
 * User: inginer
 * Date: 04.08.15
 * Time: 17:32
 */

namespace app\components;


use app\models\Feedback;
use Yii;
use yii\base\Widget;

class FeedbackWidget extends Widget
{
    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run ()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('success', Yii::t('app','Thank you for contacting us. We will reply you as soon as possible.'));

            return Yii::$app->response->refresh();
        }

        return $this->render('feedback', [
            'model' => $model,
        ]);
    }
}