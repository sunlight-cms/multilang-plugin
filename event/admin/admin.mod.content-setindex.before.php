<?php

use Sunlight\Message;
use SunlightExtend\Multilang\MultilangPlugin;

/** @param array{output: string} $args */
return function (array $args) {
    /** @var MultilangPlugin $this */
    if ($this->getConfig()['redirect_index']) {
        $args['output'] .= Message::ok(_lang('multilang.setindex_note'));
    }
};
