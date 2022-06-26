<?php

namespace api\models;

class ContactFormData extends \common\models\ContactFormData
{
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'phone',
            'phone_clear' => function (ContactFormData $model){
                return $model->getClearPhone();
            },
            'message'

        ];
    }
}