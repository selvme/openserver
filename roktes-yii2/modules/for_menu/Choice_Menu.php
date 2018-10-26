<?php
namespace app\modules\for_menu;

use yii\helpers\Url;
use app\modules\for_menu\models\DbMenu;
use app\modules\for_menu\models\DbMenuItem;
use app\modules\for_menu\models\DbSubMenuItem;

class Choice_Menu 
{
    private static function normalaze($array)
    {
        $items = [];

        foreach ($array as $item)
        {
            $items[] = $item->attributes;
        }

        return $items;
    }

    private static function getSubMenuItems($id)
    {
        $items = [];

        $query = DbSubMenuItem::find()
                    ->where([
                        'item_id' => $id,
                     ])
                    ->all();

        $items = self::normalaze($query);

        if (empty($items)) { return; }
        
        for ( $i = 0; $i < count($items); $i++ )
        {
            $result[] = [
                'id' => $items[$i]['id'],
                'label' => $items[$i]['name'],
                'url' => Url::home() . $items[$i]['url'],
                'is_parent' => $items[$i]['is_parent']
            ];
        }

        return $result;
    }

    private static function getMenuItems($nameMenu)
    {
        $query_menu = DbMenu::find()
                        ->where(['name' => $nameMenu, 'status' => 1])
                        ->one();
        
        $query = DbMenuItem::find()
                    ->where([
                        'menu_name_id' => $query_menu->id,
                     ])
                    ->all();
        
        $items = self::normalaze($query);
        
        return $items;

    }
    public static function viewMenuItems($nameMenu, $needLevels)
    {        
        $array = self::getMenuItems($nameMenu);
        
        if (empty($array)) { return; }
        
        for ( $i = 0; $i < count($array); $i++ )
        {
            if($needLevels && $array[$i]['is_parent'] == 1){
                $result[] = [
                    'label' => $array[$i]['name'],
                    'url' => Url::home() . $array[$i]['url'],
                    'items' => self::getSubMenuItems($array[$i]['id'])
                ];
            }else {
                $result[] = [
                    'label' => $array[$i]['name'],
                    'url' => Url::home() . $array[$i]['url']
                ];
            }
        }
        
        return $result;
    }
}
