<?php

namespace common\models;

use common\components\CyrillicSlugBehavior;
use mohorev\file\UploadBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string|null $slug
 * @property string $video_url
 * @property string|null $video_content
 * @property string|null $name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $status
 *
 */
class Video extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['slug','name'], 'string', 'max' => 255],
            [['video_url'], 'string'],
            ['video_content', 'file', 'extensions' => ['mp4']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => CyrillicSlugBehavior::className(),
                'attribute' => 'name',
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'uz' => 'Uzbek',
                    'ru' => 'Русский',
                    'en' => 'English',
                ],
                'attributes' => [
                    'name',
                ]
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'video' => [
                'class' => UploadBehavior::class,
                'attribute' => 'video_content',
                'scenarios' => ['default'],
                'path' => '@frontend/web/video_uploads/{id}',
                'url' => '/video_uploads/{id}',
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
            'slug' => Yii::t('app', 'Url nomi'),
            'video_url' => Yii::t('app', 'Video Url'),
            'video_content' => Yii::t('app', 'Video Fayl'),
            'name' => Yii::t('app', 'Sarlavha'),
            'created_at' => Yii::t('app', 'Yaratilgan vaqti'),
            'updated_at' => Yii::t('app', 'Tahrirlangan vaqti'),
            'status' => Yii::t('app', 'Holati'),
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

    public function getVideo()
    {
        return $this->getBehavior('video')->getUploadUrl('video_content');
    }
}
