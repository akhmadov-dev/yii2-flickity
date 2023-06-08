<?php

declare(strict_types=1);

namespace akhmadovdev\flickity;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class Flickity extends Widget
{
    /**
     * @var array widget elements for the carousel
     */
    public array $items = [];

    /**
     * @var string HTML tag to render items for the carousel
     */
    public string $itemTag = 'div';

    /**
     * @var array HTML attributes for the one item
     */
    public array $itemOptions = [];

    /**
     * @var string HTML tag to render the container
     */
    public string $containerTag = 'div';

    /**
     * @var array HTML attributes to render on the container
     */
    public array $containerOptions = [];

    /**
     * @var bool default `false`, `true` if use custom or external flickity assets
     */
    public bool $flickityCoreAssets = false;

    /**
     * @var array default `[]`, for option $('selector').flickity(pluginOptions);
     * @see https://flickity.metafizzy.co/options.html
     */
    public array $pluginOptions = [];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->items)) {
            throw new InvalidConfigException("Not allowed without or empty 'items'");
        }

        if ($this->flickityCoreAssets === false) {
            $this->view->registerAssetBundle(FlickityAsset::class);
        }

        $this->containerTag = $this->containerTag ?: 'div';
        $this->itemTag = $this->itemTag ?: 'div';

        parent::init();
    }

    public function run()
    {
        $pluginOptions = Json::encode($this->pluginOptions);

        $this->view->registerJs("$('#{$this->containerOptions['id']}').flickity({$pluginOptions});");

        $slider = Html::beginTag($this->containerTag, $this->containerOptions);
        foreach ($this->items as $item) {
            $slider .= Html::tag($this->itemTag, $item, $this->itemOptions);
        }
        $slider .= Html::endTag($this->containerTag);

        return $slider;
    }
}