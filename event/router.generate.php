<?php

use Kuria\Url\Url;
use Sunlight\Core;
use Sunlight\Settings;
use SunlightExtend\Multilang\MultilangState;

/** @param array{url: Url} $args */
return function (array $args) {
    if (MultilangState::$lang === null) {
        return;
    }

    $path = $args['url']->getPath();
    $basePath = Core::getBaseUrl()->getPath() . '/';
    $basePathLen = strlen($basePath);

    if (strncmp($path, $basePath, $basePathLen) !== 0) {
        return;
    }

    $pathInfo = substr($path, $basePathLen);

    if (Settings::get('pretty_urls')) {
        if (strncmp($pathInfo, 'm/', 2) === 0) {
            $args['url']->setPath($basePath . MultilangState::$lang->getCode() . '/' . $pathInfo);
        }
    } else {
        if (strncmp($pathInfo, 'index.php/m/', 12) === 0) {
            $args['url']->setPath($basePath . 'index.php/' . MultilangState::$lang->getCode() . '/' . substr($pathInfo, 10));
        }
    }
};
