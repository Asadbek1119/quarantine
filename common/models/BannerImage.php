<?php

namespace common\models;

use mohorev\file\UploadImageBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "banner_image".
 *
 * @property int $id
 * @property string|null $img
 * @property int|null $status
 */
class BannerImage extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            ['img', 'image', 'extensions' => ['jpg', 'png', 'jpeg']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/banner_images/{id}',
                'url' => '/uploads/banner_images/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 865, 'height' => 500, 'quality' => 90],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'img' => Yii::t('app', 'Rasm'),
            'status' => Yii::t('app', 'Holati'),
        ];
    }

    public static function getStatusFilter()
    {
        return [
            self::STATUS_ACTIVE => "Faol",
            self::STATUS_INACTIVE => "Faol emas",
        ];
    }

    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::getStatusFilter(), $this->status);
    }

    public function getImage()
    {
        return $this->getThumbUploadUrl('img','thumb');
    }
}
