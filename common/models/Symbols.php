<?php

namespace common\models;

use common\components\CyrillicSlugBehavior;
use mohorev\file\UploadBehavior;
use mohorev\file\UploadImageBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "symbols".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $title
 * @property string|null $music
 * @property string|null $slug
 * @property string|null $content
 * @property int|null $status
 *
 */
class Symbols extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'symbols';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png']],
            [['title', 'slug'], 'string', 'max' => 255],
            [['content'], 'string'],
            ['music', 'file', 'extensions' => ['mp3']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => CyrillicSlugBehavior::className(),
                'attribute' => 'title',
            ],
            'music' => [
                'class' => UploadBehavior::class,
                'attribute' => 'music',
                'scenarios' => ['default'],
                'path' => '@frontend/web/video_uploads/mp3_uploads/{id}',
                'url' =>  '/video_uploads/mp3_uploads/{id}',
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/symbols/{id}',
                'url' =>  '/uploads/symbols/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 150, 'quality' => 60],
                ],
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'uz' => 'Uzbek',
                    'ru' => 'Русский',
                    'en' => 'English',
                ],
                'attributes' => [
                    'title',
                    'content',
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
            'img' => Yii::t('app', 'Rasm'),
            'title' => Yii::t('app', 'Sarlavha'),
            'slug' => Yii::t('app', 'Url nomi'),
            'content' => Yii::t('app', 'Kontent'),
            'music' => Yii::t('app', 'Madhiya musiqasi'),
            'status' => Yii::t('app', 'Holati'),
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

    public function getMusic()
    {
        return $this->getBehavior('music')->getUploadUrl('music');
    }

    public function getImage()
    {
        return $this->getThumbUploadUrl('img', 'thumb');
    }
}
