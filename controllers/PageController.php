<?php

namespace app\controllers;

use app\models\Page;
use yii\base\InvalidParamException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class PageController
 * @package app\controllers
 * @author Ruslan Madatov <ruslanmadatov@yandex.ru>
 */
class PageController extends Controller
{

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView ($id)
    {
        $model = $this->findModel($id);

        return $this->render($this->findTemplate($model), [
            'page' => $model,
        ]);
    }

    /**
     * @param Page $page
     * @return string
     */
    private function findTemplate (Page $page)
    {
        $viewFile = "@app/views/page" . (!$page->template ? "/view.php" : '/custom-view/' . $page->template);

        if (!file_exists(\Yii::getAlias($viewFile))) {
            throw new InvalidParamException(\Yii::t('app','The view file does not exist: {file}', ['file' => \Yii::getAlias($viewFile)]));
        }

        return $viewFile;
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ($id)
    {
        if (($model = Page::findOne(['id' => $id, 'status' => 'active'])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
