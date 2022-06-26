<?php

namespace api\models;


class Menu extends \backend\modules\menumanager\models\Menu
{
    public function fields()
    {
        return [
            'id',
            'title',
            'url',
            'subMenus'
        ];
    }

    public function getSubMenus()
    {
        return $this->hasMany(Menu::class, ['root' => 'root'])
            ->andWhere(['lvl' => $this->lvl + 1])
            ->andWhere(['>', 'lft', $this->lft])
            ->andWhere(['<', 'rgt', $this->rgt]);
    }
}