<?php

namespace SunlightExtend\Multilang;

abstract class MultilangState
{
    const NONE = 0;
    const FROM_URL = 1;
    const FROM_COOKIE = 2;

    /** @var Language|null */
    static $lang = null;
    /** @var int */
    static $source = self::NONE;
    /** @var bool */
    static $userSelectionAllowed = false;
}
