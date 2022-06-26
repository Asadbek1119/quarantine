<?php

namespace api\controllers;

use api\models\SocialNetwork;

class SocialNetworkController extends DefaultController
{
    public function actionIndex()
    {
        $data = SocialNetwork::find()->andWhere(['status' => SocialNetwork::STATUS_ACTIVE])->all();

        if ($data) {
            return $this->success($data);
        } else {
            return $this->error();
        }
    }
}