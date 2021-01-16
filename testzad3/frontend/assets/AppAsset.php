<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-datepicker.css',
		'css/jquery.nselect.css',
		
		
		'css/jquery-editable-select.css',
		'css/main.css',
		  'css2/main.css',
		'css/bootstrap.min.css',
		'css/tagsinput.css',
		
    ];
    public $js = [
			'js/bootstrap-datepicker.js',
			'js/bootstrap-datepicker.ru.min.js',
			'js/jquery.nselect.min.js',
			'js/jquery-editable-select.js',
			'js/main.js',
			'js/tagsinput.js',
	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
