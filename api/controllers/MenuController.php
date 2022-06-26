<?php

namespace api\controllers;

use api\models\Menu;

class MenuController extends DefaultController
{
    public function actionIndex()
    {
        $menus =  Menu::getMenu('main_menu');
        $menus = $menus->activeSubMenus;

        if($menus){
            return [
                $this->success($menus)
            ];
        }
        else{
            return [
                $this->error()

            ];
        }

    }
}