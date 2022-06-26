<?php

namespace common\models;

use mohorev\file\UploadImageBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "leader".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $position
 * @property string|null $work_day
 * @property string|null $biography
 * @property int|null $leader_category_id
 * @property int|null $status
 *
 * @property LeaderCategory $leaderCategory
 */
class Leader extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use MultilingualLabelsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['leader_category_id', 'status'], 'integer'],
            ['img', 'image', 'extensions' => ['jpg', 'png', 'jpeg']],
            [['name', 'phone', 'email','position','work_day'], 'string', 'max' => 255],
            [['biography'], 'string'],
            [['leader_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaderCategory::className(), 'targetAttribute' => ['leader_category_id' => 'id']],
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
                    'position',
                    'work_day',
                    'biography',
                ]
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/leader/{id}',
                'url' => '/uploads/leader/{id}',
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
            'img' => Yii::t('app', 'Xodim rasmi'),
            'name' => Yii::t('app', 'Ismi'),
            'phone' => Yii::t('app', 'Telefon raqami'),
            'email' => Yii::t('app', 'Elektron pochta'),
            'work_day' => Yii::t('app', 'Qabul kunlari'),
            'position' => Yii::t('app', 'Yo\'nalishi'),
            'biography' => Yii::t('app', 'Biografiyasi'),
            'leader_category_id' => Yii::t('app', 'Kategoriyasi'),
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

    /**
     * Gets query for [[LeaderCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeaderCategory()
    {
        return $this->hasOne(LeaderCategory::className(), ['id' => 'leader_category_id']);
    }
    public function getImage()
    {
        return $this->getThumbUploadUrl('img', 'thumb');
    }
}
