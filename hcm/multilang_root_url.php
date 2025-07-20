<?php

use Sunlight\Router;
use SunlightExtend\Multilang\LanguageRoot;

return function () {
    $currentRoot = LanguageRoot::getCurrent();

    return $currentRoot !== null ? $currentRoot->getUrl() : Router::index();
};
