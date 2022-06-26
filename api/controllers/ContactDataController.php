<?php

namespace api\controllers;


use api\models\ContactData;

class ContactDataController extends DefaultController
{
    public function actionIndex()
    {
        $data = ContactData::find()->all();

        if ($data) {
            return $this->success($data);
        }
        return $this->error();
    }
}