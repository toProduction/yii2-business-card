<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%menu_item}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $position
 * @property integer $page_id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $url
 * @property string $status
 */
class MenuItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName ()
    {
        return '{{%menu_item}}';
    }

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
        return [
            [
                'class'      => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return [
            [['user_id', 'menu_id'], 'required'],
            [['user_id', 'created_at', 'page_id', 'menu_id', 'parent_id', 'position'], 'integer'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 250],
            [['url'], 'string', 'max' => 1000],
            [['parent_id', 'position'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 'active'],
        ];
    }

    public function getPage ()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    public function getSubMenu ()
    {
        return $this->hasMany(MenuItem::className(), ['parent_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels ()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'name'       => Yii::t('app', 'Name'),
            'user_id'    => Yii::t('app', 'User'),
            'created_at' => Yii::t('app', 'Created At'),
            'page_id'    => Yii::t('app', 'Page'),
            'position'   => Yii::t('app', 'Position'),
            'parent_id'  => Yii::t('app', 'Parent'),
            'menu_id'    => Yii::t('app', 'Menu'),
            'url'        => Yii::t('app', 'Link'),
            'status'     => Yii::t('app', 'Status'),
        ];
    }

    /**
     * This method is invoked before validation starts.
     * The default implementation raises a `beforeValidate` event.
     * You may override this method to do preliminary checks before validation.
     * Make sure the parent implementation is invoked so that the event can be raised.
     * @return boolean whether the validation should be executed. Defaults to true.
     * If false is returned, the validation will stop and the model is considered invalid.
     */
    public function beforeValidate ()
    {
        $this->user_id = Yii::$app->user->id;

        if (!$this->name && !$this->page_id) {
            $this->addError('name', 'Название не может быть пустым');
            $this->addError('url', 'Ссылка не может быть пустым');
        }

        return parent::beforeValidate();
    }

    /**
     * @return string
     */
    public function getViewUrl ()
    {
        return ($this->page_id ? Url::to(['/page/view', 'id' => $this->page_id]) : $this->url);
    }

    /**
     * @return string
     */
    public function getEditUrl ()
    {
        return Url::to(['/backoffice/menu/sub-menu-update', 'menu_id' => $this->menu_id, 'item_id' => $this->id]);
    }

    /**
     * @return string
     */
    public function getLabel ()
    {
        return ($this->page_id && !$this->name ? $this->page->name : $this->name);
    }

    public static function getPageWithName (array $params)
    {
        $model = self::findAll($params);
        $items = [];
        foreach ($model as $item) {
            $items[ $item->id ] = !$item->name && !empty($item->page->name) ? $item->page->name : $item->name;
        }

        return $items;
    }

    /**
     * This method is invoked after deleting a record.
     * The default implementation raises the [[EVENT_AFTER_DELETE]] event.
     * You may override this method to do postprocessing after the record is deleted.
     * Make sure you call the parent implementation so that the event is raised properly.
     */
    public function afterDelete ()
    {
        $this->deleteAll(['parent_id' => $this->id]);
        parent::afterDelete();
    }

    /**
     * This method is called at the beginning of inserting or updating a record.
     * The default implementation will trigger an [[EVENT_BEFORE_INSERT]] event when `$insert` is true,
     * or an [[EVENT_BEFORE_UPDATE]] event if `$insert` is false.
     * When overriding this method, make sure you call the parent implementation like the following:
     *
     * ```php
     * public function beforeSave($insert)
     * {
     *     if (parent::beforeSave($insert)) {
     *         // ...custom code here...
     *         return true;
     *     } else {
     *         return false;
     *     }
     * }
     * ```
     *
     * @param boolean $insert whether this method called while inserting a record.
     * If false, it means the method is called while updating a record.
     * @return boolean whether the insertion or updating should continue.
     * If false, the insertion or updating will be cancelled.
     */
    public function beforeSave ($insert)
    {
        if ($insert) {
            $lastPosition = self::find()->where(['menu_id' => $this->menu_id, 'parent_id' => $this->parent_id])->count();
            $this->position = ++$lastPosition;
        }

        return parent::beforeSave($insert);
    }

    /**
     * This method is called at the end of inserting or updating a record.
     * The default implementation will trigger an [[EVENT_AFTER_INSERT]] event when `$insert` is true,
     * or an [[EVENT_AFTER_UPDATE]] event if `$insert` is false. The event class used is [[AfterSaveEvent]].
     * When overriding this method, make sure you call the parent implementation so that
     * the event is triggered.
     * @param boolean $insert whether this method called while inserting a record.
     * If false, it means the method is called while updating a record.
     * @param array $changedAttributes The old values of attributes that had changed and were saved.
     * You can use this parameter to take action based on the changes made for example send an email
     * when the password had changed or implement audit trail that tracks all the changes.
     * `$changedAttributes` gives you the old attribute values while the active record (`$this`) has
     * already the new, updated values.
     */
    public function afterSave ($insert, $changedAttributes)
    {
        if (!$insert && isset($changedAttributes['position'])) {
            self::updateAllCounters(['position' => 1], 'id!=:id AND menu_id=:menu_id AND parent_id=:parent_id
            AND position BETWEEN :position AND :position2', [
                ':menu_id'   => $this->menu_id,
                ':parent_id' => $this->parent_id,
                ':position'  => $this->position,
                ':position2' => $changedAttributes['position'],
                ':id'        => $this->id,
            ]);
        }
        parent::afterSave($insert, $changedAttributes);
    }

}
