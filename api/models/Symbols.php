<?php

namespace api\models;

use Yii;
use yii\helpers\Url;

class Symbols extends \common\models\Symbols
{
    public function fields()
    {
        return [
            'id',
            'title',
            'music' => function ($model) {
                return Url::base() . $model->getMusic();
            },
            'image' => function ($model) {
                return Url::base() . $model->getImage();
            },
            'content'
        ];
    }
}