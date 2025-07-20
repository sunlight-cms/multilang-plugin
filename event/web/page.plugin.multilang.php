<?php

use SunlightExtend\Multilang\MultilangPlugin;

/** @param array{page: array, script: string} $args */
return function (array $args) {
    /** @var MultilangPlugin $this */
    $args['script'] = $this->getDirectory() . '/script/page_multilang.php';
};
