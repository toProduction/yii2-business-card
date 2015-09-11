<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $full_text
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $title
 * @property string $alias
 * @property string $status
 * @property string $template
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $menu_id
 */
class Page extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName ()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return [
            [['description', 'full_text', 'template'], 'string'],
            [['full_text', 'created_at', 'updated_at', 'name', 'status'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'menu_id'], 'integer'],
            [['name'], 'string', 'max' => 1000],
            [['alias'], 'string', 'max' => 100],
            [['title', 'meta_keywords', 'meta_description'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels ()
    {
        return [
            'id'               => Yii::t('app', 'ID'),
            'name'             => Yii::t('app', 'Name'),
            'description'      => Yii::t('app', 'Description'),
            'full_text'        => Yii::t('app', 'Full Text'),
            'user_id'          => Yii::t('app', 'User'),
            'created_at'       => Yii::t('app', 'Created At'),
            'updated_at'       => Yii::t('app', 'Updated At'),
            'title'            => Yii::t('app', 'Title'),
            'alias'            => Yii::t('app', 'Alias'),
            'meta_keywords'    => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'status'           => Yii::t('app', 'Status'),
            'template'         => Yii::t('app', 'Template'),
            'menu_id'          => Yii::t('app', 'Menu'),
        ];
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
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
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
        $this->updated_at = time();
        if ($this->isNewRecord) {
            $this->created_at = time();
        }

        return parent::beforeValidate();
    }

    /**
     * @return array
     */
    public static function templateList ()
    {
        $templatePath = Yii::getAlias('@app/views/page/custom-view');
        $files = [];

        if (is_dir($templatePath)) {
            foreach (FileHelper::findFiles($templatePath, ['only' => ['*.php']]) as $file) {
                $files[ basename($file) ] = basename($file);
            }
        }

        return $files;
    }
}