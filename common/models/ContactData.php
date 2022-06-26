<?php

namespace common\models;

use mohorev\file\UploadBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "contact_data".
 *
 * @property int $id
 * @property string|null $address
 * @property string|null $destination
 * @property string|null $work_time
 * @property string|null $phone_first
 * @property string|null $phone_second
 * @property string|null $lunch_time
 * @property string|null $download
 * @property string|null $bank_detail
 */
class ContactData extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'email'],
            [['address', 'destination', 'work_time', 'phone_first', 'phone_second', 'lunch_time'], 'string', 'max' => 255],
            [['bank_detail'], 'string'],
            ['download', 'file', 'extensions' => ['pdf']],
        ];
    }

    public function behaviors()
    {
        return [
            'download' => [
                'class' => UploadBehavior::class,
                'attribute' => 'download',
                'scenarios' => ['default'],
                'path' => '@frontend/web/file_uploads/{id}',
                'url' => '/file_uploads/{id}',
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'uz' => 'Uzbek',
                    'ru' => 'Русский',
                    'en' => 'English',
                ],
                'attributes' => [
                    'address',
                    'destination',
                    'work_time',
                    'bank_detail',
                ]
            ],
        ];
    }

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'E_Pochta'),
            'address' => Yii::t('app', 'Manzil'),
            'destination' => Yii::t('app', 'Mo\'ljal'),
            'phone_first' => Yii::t('app', 'Birinchi raqam'),
            'phone_second' => Yii::t('app', 'Ikkinchi raqam'),
            'lunch_time' => Yii::t('app', 'Tushlik vaqti'),
            'download' => Yii::t('app', 'PDF yuklab olish'),
            'bank_detail' => Yii::t('app', 'Bank Rekvizitlari'),
        ];
    }

    public static function getStatusFilter()
    {
        return [
            self::STATUS_ACTIVE => 'FAOL',
            self::STATUS_INACTIVE => 'FAOL EMAS'
        ];
    }

    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::getStatusFilter(), $this->status);
    }
    public function getDownload()
    {
        return $this->getBehavior('download')->getUploadUrl('download');
    }
}
