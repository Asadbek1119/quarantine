<?php

namespace api\controllers;

use api\models\UsefulLink;

class UsefulLinkController extends DefaultController
{
    public function actionIndex()
    {
        $data = UsefulLink::find()->andWhere(['status' => UsefulLink::STATUS_ACTIVE])->all();

        if ($data) {
            return $this->success($data);
        } else {
            return $this->error();
        }
    }
}