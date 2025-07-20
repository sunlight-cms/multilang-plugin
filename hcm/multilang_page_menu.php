<?php

use Sunlight\Hcm;
use Sunlight\Template;
use SunlightExtend\Multilang\LanguageRoot;

return function ($ord_start = null, $ord_end = null, $max_depth = 1, $class = null) {
    $root = LanguageRoot::getCurrent();

    if ($root === null) {
        return '';
    }

    Hcm::normalizeArgument($ord_start, 'int', true);
    Hcm::normalizeArgument($ord_end, 'int', true);
    Hcm::normalizeArgument($max_depth, 'int', true);
    Hcm::normalizeArgument($class, 'string', true);

    return Template::treeMenu([
        'page_id' => $root->getId(),
        'max_depth' => $max_depth,
        'ord_start' => $ord_start,
        'ord_end' => $ord_end,
        'css_class' => $class,
    ]);
};
