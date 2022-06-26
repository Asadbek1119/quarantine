<?php

namespace common\models;

use common\components\CyrillicSlugBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post_category".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property int|null $status
 */
class PostCategory extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => CyrillicSlugBehavior::className(),
                'attribute' => 'name',
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
            'slug' => Yii::t('app', 'Url Nnomi'),
            'name' => Yii::t('app', 'Kategoriya nomi'),
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

    public static function categories()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
