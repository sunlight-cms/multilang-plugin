<?php

namespace SunlightExtend\Multilang;

use Kuria\RequestInfo\RequestInfo;

abstract class MultilangRouter
{
    static function getLanguageFromUrl(): ?Language
    {
        $slug = RequestInfo::getPathInfo();

        if (strncmp($slug, '/', 1) === 0) {
            $slug = substr($slug, 1);
        }

        $slashPos = strpos($slug, '/');

        if ($slashPos !== false) {
            $maybeCode = substr($slug, 0, $slashPos);
        } else {
            $maybeCode = $slug;
        }

        return Language::tryFromCode($maybeCode);
    }
}
