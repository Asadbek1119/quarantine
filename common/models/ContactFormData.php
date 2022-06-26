<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "contact_form_data".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $message
 * @property string $created_at
 * @property int|null $status
 */
class ContactFormData extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_form_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'phone', 'message'], 'required'],
            [['message'], 'string'],
            [['status'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['created_at'], 'string', 'max' => 100],
            ['phone', 'match', 'pattern' => '/\+[9][9][8] \([0-9][0-9]\) [0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]/'],
            [['email'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Foydalanuvchi ismi'),
            'email' => Yii::t('app', 'Elektron pochta'),
            'phone' => Yii::t('app', 'Telefon raqam'),
            'message' => Yii::t('app', 'Xabar'),
            'created_at' => Yii::t('app', 'Yaratilgan vaqti'),
            'status' => Yii::t('app', 'Holati'),
        ];
    }

    public static function getStatusFilter()
    {
        return [
            self::STATUS_ACTIVE => 'Ko\'rilgan',
            self::STATUS_INACTIVE => 'Ko\'rilmagan',
        ];
    }

    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::getStatusFilter(), $this->status);
    }

    public function getClearPhone()
    {
        return strtr($this->phone,[
            '-' => '-',
            ' ' => '-',
        ]);
    }
}
