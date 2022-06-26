<?php

namespace api\models;

class UsefulLink extends \common\models\UsefulLink
{
    public function fields()
    {
        return [
            'id',
            'name',
            'url_name',
        ];
    }
}