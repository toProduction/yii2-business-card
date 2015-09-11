<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * JsTreeAsset
 *
 * @author Ruslan Madatov <ruslanmadatov@yandex.ru>
 */
class JsTreeAsset extends AssetBundle
{
    public $sourcePath = '@bower/jstree/dist';
    public $css = [
        'themes/default/style.min.css'
    ];

    public $js = [
        'jstree.min.js',
        '/backoffice/js/jsTree.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}