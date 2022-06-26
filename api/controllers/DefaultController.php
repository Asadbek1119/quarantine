<?php

namespace api\controllers;

use yii\rest\Controller;

class DefaultController extends Controller
{
    public $layout = false;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    /**
     * @param $data
     * @param $message
     * @return array
     */
    public function success($data = [], $message = null)
    {
        return [
            'message' => 'success',
            'status' => '200',
            'data' => $data,
        ];
    }

    /**
     * @param $message
     * @return array
     */
    public function error($message = null)
    {
        if ($message == null) {
            $message = 'error';
        }
        return [
            'message' => $message,
            'status' => '403',
        ];
    }
}