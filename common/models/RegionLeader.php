<?php

namespace common\models;

use mohorev\file\UploadImageBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "region_leader".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $email
 * @property int|null $region_id
 * @property int|null $status
 * @property string $title
 * @property string $work_day
 *
 * @property Region $region
 */
class RegionLeader extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region_leader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'status'], 'integer'],
            [['name', 'phone', 'fax', 'email','title','work_day'], 'string', 'max' => 255],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'uz' => 'Uzbek',
                    'ru' => 'Русский',
                    'en' => 'English',
                ],
                'attributes' => [
                    'title',
                    'work_day',
                ]
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/region_leader/{id}',
                'url' => '/uploads/region_leader/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 150, 'height' => 200, 'quality' => 90],
                ],
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
            'img' => Yii::t('app', 'Rasm'),
            'name' => Yii::t('app', 'Ismi'),
            'phone' => Yii::t('app', 'Telefon raqam'),
            'fax' => Yii::t('app', 'Faks raqam'),
            'email' => Yii::t('app', 'Elektron pochta'),
            'region_id' => Yii::t('app', 'Hudud nomi'),
            'status' => Yii::t('app', 'Holati'),
            'title' => Yii::t('app', 'Sarlavha'),
            'work_day' => Yii::t('app', 'Qabul kunlari'),
        ];
    }

    public static function getStatusFilter()
    {
        return [
            self::STATUS_ACTIVE => 'Faol',
            self::STATUS_INACTIVE => 'Faol emas',
        ];
    }

    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::getStatusFilter(), $this->status);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getImage()
    {
        return $this->getThumbUploadUrl('img','thumb');
    }
}
