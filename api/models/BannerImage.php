<?php

namespace api\models;

class BannerImage extends \common\models\BannerImage
{
    public function fields()
    {
        return [
            'id',
            'image' => function (BannerImage $model) {
                return $model->getImage();
            }
        ];
    }
}