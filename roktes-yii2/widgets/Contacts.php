<?php

namespace app\widgets;

use Yii;

class Contacts extends \yii\bootstrap\Widget
{
    public function run(){
        return $this->render('viewContacts');
    }
}
