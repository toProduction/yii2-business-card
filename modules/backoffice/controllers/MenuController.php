<?php

namespace app\modules\backoffice\controllers;

use app\models\MenuItem;
use app\models\Page;
use Yii;
use app\models\Menu;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * Child classes may override this method to specify the behaviors they want to behave as.
     *
     * The return value of this method should be an array of behavior objects or configurations
     * indexed by behavior names. A behavior configuration can be either a string specifying
     * the behavior class or an array of the following structure:
     *
     * ~~~
     * 'behaviorName' => [
     *     'class' => 'BehaviorClass',
     *     'property1' => 'value1',
     *     'property2' => 'value2',
     * ]
     * ~~~
     *
     * Note that a behavior class must extend from [[Behavior]]. Behavior names can be strings
     * or integers. If the former, they uniquely identify the behaviors. If the latter, the corresponding
     * behaviors are anonymous and their properties and methods will NOT be made available via the component
     * (however, the behaviors can still respond to the component's events).
     *
     * Behaviors declared in this method will be attached to the component automatically (on demand).
     *
     * @return array the behavior configurations.
     */
    public function behaviors ()
    {
        return array_merge([
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'index',
                            'update',
                            'delete',
                            'view',
                            'sub-menu-update',
                            'sub-menu-delete',
                            'sub-menu-create',
                        ],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'sub-menu-delete'],
                ],
            ],
        ], parent::behaviors());
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex ()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView ($id)
    {
        return $this->redirect(['/backoffice/menu/update', 'id' => $id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate ()
    {
        $model = new Menu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Menu added'));

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate ($id)
    {
        $model = $this->findModel($id);
        $modelMenuItem = new MenuItem;

        $modelPages = ArrayHelper::map(Page::findAll(['status' => 'active']), 'id', 'name');

        if ($modelMenuItem->load(Yii::$app->request->post())) {
            $modelMenuItem->menu_id = $model->id;
            if ($modelMenuItem->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Sub menu added'));

                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Menu was saved'));

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'         => $model,
            'modelMenuItem' => $modelMenuItem,
            'items'         => $modelMenuItem->findAll(['menu_id' => $model->id]),
            'modelPages'    => $modelPages,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete ($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSubMenuCreate ($menu_id, $item_id)
    {
        $menu = $this->findModel($menu_id);
        $modelMenuItem = new MenuItem;
        $menuItem = $modelMenuItem->findOne(['id' => $item_id, 'menu_id' => $menu->id]);

        if (!$menuItem) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        if ($modelMenuItem->load(Yii::$app->request->post())) {
            $modelMenuItem->parent_id = $menuItem->id;
            $modelMenuItem->menu_id = $menu->id;
            if ($modelMenuItem->save()) {
                Yii::$app->session->setFlash('success', 'Sub menu was added');

                return $this->redirect(['/backoffice/menu/update', 'id' => $menu->id]);
            }
        }

        return $this->render(Yii::$app->request->isAjax ? '_sub_menu_form' : 'sub_menu_create', [
            'menu'     => $menu,
            'menuItem' => $menuItem,
            'model'    => $modelMenuItem,
        ]);
    }

    public function actionSubMenuUpdate ($menu_id, $item_id)
    {
        $menu = $this->findModel($menu_id);
        $modelMenuItem = MenuItem::findOne(['id' => $item_id, 'menu_id' => $menu->id]);

        if (!$modelMenuItem) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        if ($modelMenuItem->load(Yii::$app->request->post())) {
            $modelMenuItem->menu_id = $menu->id;
            if ($modelMenuItem->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Sub menu saved'));
                if (!Yii::$app->request->isAjax) {
                    return $this->redirect(['/backoffice/menu/update', 'id' => $menu->id]);
                } else {
                    return json_encode(['success' => Yii::$app->session->getFlash('success')]);
                }

            }
        }
        $params = [
            'menu'       => $menu,
            'model'      => $modelMenuItem,
            'modelPages' => ArrayHelper::map(Page::findAll(['status' => 'active']), 'id', 'name'),
        ];

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_sub_menu_form', $params);
        } else {
            return $this->renderAjax('sub_menu_create', $params);
        }
    }

    public function actionSubMenuDelete ($id, $menu_id)
    {
        $this->findModelMenuItem($id)->delete();

        return $this->redirect(['update', 'id' => $menu_id]);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMenuItem ($id)
    {
        if (($model = MenuItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
