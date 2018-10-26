<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;

class Hform extends Model
{
    public $city;
    public $name;
    public $phone;
    public $email;
    public $text;
    public $check;
    public $reCaptcha;

    public function rules()
    {
        return [
            [['phone', 'name', 'email', 'text', 'reCaptcha', 'check'], 'required'],
            ['email', 'email'],
            ['check', 'boolean'],
            ['phone', 'string'],
            ['phone', PhoneInputValidator::className()],
            ['text', 'trim'],
            ['text', 'string', 'max'=>255],
            [['reCaptcha'], ReCaptchaValidator::className(), 'uncheckedMessage' => 'Пожалуйста подтвердите что Вы не бот.']
        ];
    }
    public function sendForm($email){
        $message = Yii::$app->mailer->compose('html2', [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'text' => $this->text,
            'city' => $this->city,
        ]);
        $message->setTo($email)
            ->setFrom(['roktesltd@yandex.ru' => 'Запрос с сайта Roktes.ru'])
            ->setSubject($this->name);
        if ($message->send()) {
            return true;
        }
        return false;
    }
}