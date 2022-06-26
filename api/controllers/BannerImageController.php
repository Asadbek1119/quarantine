<?php

namespace api\controllers;

use api\models\BannerImage;

class BannerImageController extends DefaultController
{
    public function actionIndex()
    {
        $data = BannerImage::find()->andWhere(['status' => BannerImage::STATUS_ACTIVE])->all();

        if ($data) {
            return $this->success($data);
        } else {
            return $this->error();
        }
    }
}