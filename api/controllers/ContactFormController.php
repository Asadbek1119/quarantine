<?php

namespace api\controllers;

use api\models\ContactFormData;
use Yii;

class ContactFormController extends DefaultController
{
    public function actionIndex()
    {
        $data = new ContactFormData();
        $json = json_decode(\Yii::$app->request->getRawBody(), true);
        $data->username = $json['username'];
        $data->email = $json['email'];
        $data->phone = $json['phone'];
        $data->message = $json['message'];

        if ($data->validate()) {
            $chat_id = '644096965';
            Yii::$app->telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => '<b>Yangi xabar: </b>' . "\n" . '🙎🏻‍♂ <b>Ismi</b>: ' . $data->username . "\n" . '🙎🏻‍♂ <b>E-pochta</b>: ' . $data->email . "\n" .
                    '📞 <b>Telefon raqami</b>: ' . $data->getClearPhone() . "\n" . '💡 <b>Xabar</b>: ' . $data->message,
                'parse_mode' => 'html'
            ]);
            if ($data->save()) {
                return $this->success($data);
            } else {
                return $this->error('Xatolik yuzaga keldi!');
            }
        } else {
            $errorArray = [];
            foreach ($data->getErrors() as $key => $val) {
                $errorArray[] = [
                    'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
                ];
            }
            return $errorArray[0];
        }
    }
}