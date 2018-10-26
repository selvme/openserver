<?php

namespace app\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

class RoktesBreadcrumbs extends Breadcrumbs
{
    public $tag = 'div';
    public $seoOptions = [
        'xmlns:v' => 'http://rdf.data-vocabulary.org/#',
        ];
    public $linkSeoOptions = [
        'rel' => 'v:url',
        'property' => 'v:title'
        ];
    public $itemTemplate =  "<span typeof=\"v:Breadcrumb\">\n"
                                . "{link}\n"
                            . "</span>\n";
    public $activeItemTemplate =    "<span>\n"
                                        . "{link}\n"
                                    . "</span>\n";

    public function init()
    {
        $this->options = array_merge($this->options, $this->seoOptions);
    }

    protected function renderItem($link, $template)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (isset($link['template'])) {
            $template = $link['template'];
        }

        if (isset($link['url'])) {
            $options = $link;
            $options = array_merge($options, $this->linkSeoOptions);

            unset($options['template'], $options['label'], $options['url']);
            $link = Html::a($label, $link['url'], $options);
        } else {
            $link = $label;
        }

        return strtr($template, ['{link}' => $link]);
    }
}