<?php

namespace api\models;

class ContactData extends \common\models\ContactData
{
    public function fields()
    {
        return [
            'id',
            'address',
            'destination',
            'work_time',
            'email',
            'phone_first',
            'phone_second',
            'lunch_time',
            'download' => function (\common\models\ContactData $model) {
                return $model->getDownload();
            },
            'bank_detail',
        ];
    }
}