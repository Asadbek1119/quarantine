<?php

namespace api\controllers;

use api\models\Symbols;

class SymbolsController extends DefaultController
{
    public function actionIndex()
    {
        $data = Symbols::find()->andWhere(['status' => Symbols::STATUS_ACTIVE])->all();

        if ($data) {
            return $this->success($data);
        } else {
            return $this->error();
        }
    }
}