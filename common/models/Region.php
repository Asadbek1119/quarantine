<?php

namespace common\models;

use common\components\CyrillicSlugBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $region_name
 * @property int|null $status
 */
class Region extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['slug', 'region_name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => CyrillicSlugBehavior::className(),
                'attribute' => 'region_name',
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
            'slug' => Yii::t('app', 'Url nomi'),
            'region_name' => Yii::t('app', 'Hudud nomi'),
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
        return ArrayHelper::getValue($this->getStatusFilter(), $this->status);
    }

    public static function getRegions()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'region_name');
    }
}
