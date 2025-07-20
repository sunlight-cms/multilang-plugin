<?php

/** @param array{infos: array<string, string>} $args */

use SunlightExtend\Multilang\LanguageRoot;

/** @param array{infos: array<string, string>} $args */
return function (array $args) {
    $args['infos'][LanguageRoot::TYPE_IDT] = _lang('multilang.page_label');
};
