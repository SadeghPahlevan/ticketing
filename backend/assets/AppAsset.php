<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'layout/assets/css/bootstrap.min.css',
        'layout/assets/css/material-dashboard.css',
        'layout/assets/css/demo.css',
        'layout/icon.css'

    ];
    public $js = [
        'layout/assets/js/jquery-3.1.0.min.js',
        'layout/assets/js/bootstrap.min.js',
        'layout/assets/js/material.min.js',
        'layout/assets/js/chartist.min.js',
        'layout/assets/js/bootstrap-notify.js',
        'layout/assets/js/material-dashboard.js',
        'layout/assets/js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


