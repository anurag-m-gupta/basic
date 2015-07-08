<?php


namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ExcelAsset extends AssetBundle
{
    public $sourcePath = '@vendor/phpoffice/phpexcel';
    
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
