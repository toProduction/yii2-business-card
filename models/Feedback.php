<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contact_form}}".
 *
 * @property integer $id
 * @property string $subject
 * @property string $name
 * @property string $email
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $touch
 */
class Feedback extends ActiveRecord
{
    public $verifyCode;

    /**
     * Declares the name of the database table associated with this AR class.
     * By default this method returns the class name as the table name by calling [[Inflector::camel2id()]]
     * with prefix [[Connection::tablePrefix]]. For example if [[Connection::tablePrefix]] is 'tbl_',
     * 'Customer' becomes 'tbl_customer', and 'OrderItem' becomes 'tbl_order_item'. You may override this method
     * if the table is not named after this convention.
     * @return string the table name
     */
    public static function tableName ()
    {
        return '{{%feedback}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules ()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            [['created_at', 'updated_at', 'touch'], 'integer'],
            [['subject'], 'string', 'max' => 250],
            [['name', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels ()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'subject'    => Yii::t('app', 'Subject'),
            'name'       => Yii::t('app', 'Name'),
            'email'      => Yii::t('app', 'Email'),
            'body'       => Yii::t('app', 'Body'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'touch'      => Yii::t('app', 'Touch'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact ($email)
    {
        if ($this->validate() && $this->save()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }

        return false;
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
        if ($this->isNewRecord) {
            $this->created_at = time();
        }
        $this->updated_at = time();

        return parent::beforeValidate();
    }


}
