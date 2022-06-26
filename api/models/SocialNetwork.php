<?php

namespace api\models;

class SocialNetwork extends \common\models\SocialNetwork
{
    public function fields()
    {
        return [
            'id',
            'url_name',
            'icon_code',
        ];
    }
}