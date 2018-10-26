<?php

namespace app\widgets;

use Yii;
use app\modules\for_menu\Choice_Menu;

class Footer extends \yii\bootstrap\Widget
{
    public function run(){
    	$menuItems = Choice_Menu::viewMenuItems('main', false);
        return $this->render('viewFooter', ['menuItems' => $menuItems]);
    }
}
