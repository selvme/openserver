<?php

namespace app\widgets;

use Yii;

class Partners extends \yii\bootstrap\Widget
{
    public function run(){
        return $this->render('viewPartners');
    }
}
