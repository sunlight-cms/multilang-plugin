<?php

namespace SunlightExtend\Multilang;

abstract class LanguageGuesser
{
    static function guessBestRoot(): ?LanguageRoot
    {
        $roots = LanguageRoot::all();

        // use last known language if possible
        $lastUsedLang = MultilangCookie::getLastUsedLanguage();

        if ($lastUsedLang !== null) {
            $root = $roots[$lastUsedLang->getCode()] ?? null;

            if ($root !== null) {
                // found a root matching the last language
                return $root;
            }
        }

        // attempt find a root based on Accept-Language
        $preferredLangs = AcceptLanguage::getPreferred();

        foreach ($preferredLangs as $lang) {
            $root = $roots[$lang->getCode()] ?? null;

            if ($root !== null) {
                // found a root matching a preferred language
                return $root;
            }
        }

        $defaultLang = LanguageService::getDefault();

        if ($defaultLang !== null) {
            $root = $roots[$defaultLang->getCode()] ?? null;

            if ($root !== null) {
                // found a root for the default system language
                return $root;
            }
        }

        // found nothing
        return null;
    }
}
