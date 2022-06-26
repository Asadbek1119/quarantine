<?php

namespace common\models;

use mohorev\file\UploadBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "downloads".
 *
 * @property int $id
 * @property string $file_icon
 * @property string $file_download
 * @property string $file_name
 * @property int|null $status
 * @property int|null $subcategory_id
 */
class Downloads extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'downloads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['file_icon', 'file_name'], 'string', 'max' => 255],
            ['file_download', 'file', 'extensions' => ['pdf','docx','doc','xlsx','xls','pptx']],
            [['subcategory_id'],'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'file_download' => [
                'class' => UploadBehavior::class,
                'attribute' => 'file_download',
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
                    'file_name',
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
            'file_icon' => Yii::t('app', 'Ikonka'),
            'file_download' => Yii::t('app', 'Yuklangan fayl'),
            'file_name' => Yii::t('app', 'Fayl nomi'),
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
    public function getDownload()
    {
        return $this->getBehavior('file_download')->getUploadUrl('file_download');
    }
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }
}
