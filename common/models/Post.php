<?php

namespace common\models;

use common\components\CyrillicSlugBehavior;
use mohorev\file\UploadImageBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $content
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $post_category_id
 * @property int|null $status
 *
 * @property PostCategory $postCategory
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'post_category_id', 'status'], 'integer'],
            ['img', 'image', 'extensions' => ['jpg', 'png', 'jpeg']],
            [['slug', 'title'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['post_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['post_category_id' => 'id']],
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
                    'content',
                ]
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            'slug' => [
                'class' => CyrillicSlugBehavior::class,
                'attribute' => 'title',
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/post/{id}',
                'url' => '/uploads/post/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 250, 'height' => 167, 'quality' => 90],
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
            'slug' => Yii::t('app', 'Url nomi'),
            'title' => Yii::t('app', 'Sarlavha'),
            'content' => Yii::t('app', 'Kontent'),
            'created_at' => Yii::t('app', 'Yaratilgan sana'),
            'updated_at' => Yii::t('app', 'Tahrirlangan sana'),
            'post_category_id' => Yii::t('app', 'Kategoriya nomi'),
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

    /**
     * Gets query for [[PostCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'post_category_id']);
    }

    public function getImage()
    {
        return $this->getThumbUploadUrl('img', 'thumb');
    }
}
