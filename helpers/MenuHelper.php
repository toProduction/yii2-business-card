<?php
/**
 * Created by PhpStorm.
 * User: inginer
 * Date: 31.07.15
 * Time: 17:48
 */

namespace app\helpers;


use app\models\Menu;
use app\models\MenuItem;
use yii\web\ConflictHttpException;

/**
 * Class MenuHelper
 * @package app\helpers
 * @author Ruslan Madatov <ruslanmadatov@yandex.ru>
 */
class MenuHelper
{
    /**
     * @param $id
     * @param $type
     * @param array $addMenuItems
     * @return array
     */
    public static function getMenuById ($id, $type, array $addMenuItems = [])
    {
        $menu = self::findMenu($id);
        if (!$menu) {
            return $addMenuItems;
        }
        $items = MenuItem::find();
        $items->where([
            'menu_id'   => $menu->id,
            'parent_id' => 0
        ]);
        $items->orderBy(['position' => SORT_ASC]);
        $data = [];

        foreach ($items->all() as $item) {
            $data[] = self::recuresive($item, $type);
        }

        return array_merge($data, $addMenuItems);
    }

    /**
     * @param MenuItem $item
     * @param $type
     * @return array
     * @throws ConflictHttpException
     */
    private static function recuresive (MenuItem $item, $type)
    {
        $items = [];
        foreach ($item->subMenu as $subItem) {
            $items['items'][] = self::recuresive($subItem, $type);
        }
        $items['label'] = $item->getLabel();

        switch ($type) {
            case 'view':
                $items['url'] = $item->getViewUrl();
                break;
            case 'edit':
                $items['url'] = $item->getEditUrl();
                $items['options']['id'] = $item->id;

                $items['options']['data-jstree'] = json_encode([
                    'type'      => (!$item->page_id ? 'link' : 'page'),
                    'opened'    => true,
                    'parent_id' => $item->parent_id,
                    'menu_id'   => $item->menu_id,
                ]);

                break;
            default:
                throw new ConflictHttpException(\Yii::t('app', "Not correct type: {type}", ['type' => $type]));
        }

        return $items;
    }

    /**
     * @param $id
     * @return array|null|static
     */
    private static function findMenu ($id)
    {
        $model = Menu::findOne(['id' => $id]);

        if (!$model) {
            return [];
        }

        return $model;
    }
}