<?php

use Sunlight\Extend;
use Sunlight\GenericTemplates;
use SunlightExtend\Multilang\LanguageRoot;

return function () {
    $items = [];

    $currentRoot = LanguageRoot::getCurrent();

    foreach (LanguageRoot::all() as $root) {
        $items[] = [
            'root' => $root,
            'text' => $root->getTitle(),
            'link_attrs' => [
                'href' => $root->getUrl(),
            ],
            'item_attrs' => [
                'class' => 'lang-' . $root->getLang()->getCode()
                    . ($root === $currentRoot ? ' active' : ''),
                'title' => $root->getLang()->getTitle(),
            ],
        ];
    }

    $output = Extend::buffer('multilang.menu', ['items' => &$items]);

    if ($output === '') {
        $output .= '<ul class="multilang-menu">' . "\n";

        foreach ($items as $item) {
            $output .= '<li' . GenericTemplates::renderAttrs($item['item_attrs']) . '>'
                . '<a' . GenericTemplates::renderAttrs($item['link_attrs']) . '>'
                . $item['text']
                . '</a>'
                . "</li>\n";
        }

        $output .= "</ul>\n";
    }

    return $output;
};
