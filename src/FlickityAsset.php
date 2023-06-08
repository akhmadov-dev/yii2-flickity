<?php

namespace akhmadovdev\flickity;

use yii\web\AssetBundle;

class FlickityAsset extends AssetBundle
{
    public $sourcePath = '@bower/flickity/dist';

    public $css = [
        'flickity.css'
    ];

    public $js = [
        'flickity.pkgd.js'
    ];
}