<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ChatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/chat.css',
    ];
    public $js = [
        'js/chat.js',
    ];
}