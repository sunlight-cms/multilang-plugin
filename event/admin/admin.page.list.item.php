<?php

/** @param array{item: array, options: array, is_accessible: bool} $args */

use Sunlight\Page\Page;
use Sunlight\Router;
use SunlightExtend\Multilang\LanguageRoot;

return function (array $args) {
    if ($args['item']['type'] != Page::PLUGIN || $args['item']['type_idt'] !== LanguageRoot::TYPE_IDT) {
        return;
    }

    // add validation errors
    $validation_errors = LanguageRoot::validate($args['item']);

    if (empty($validation_errors)) {
        return;
    }

    $args['item']['title'] .= ' <img'
        . ' class="icon"'
        . ' alt="warn"'
        . ' title="' . _e(_lang('multilang.invalid_root') . ":\n\n" . implode("\n", $validation_errors)) . '"'
        . ' src="' . _e(Router::path('admin/public/images/icons/warn.png')) . '"'
        . '>';
};
