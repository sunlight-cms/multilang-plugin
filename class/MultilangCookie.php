<?php

namespace SunlightExtend\Multilang;

use Sunlight\Util\Cookie;

abstract class MultilangCookie
{
    private static $cookieName;

    static function isEnabled(): bool
    {
        return self::getCookieName() !== null;
    }

    static function getLastUsedLanguage(): ?Language
    {
        if (!self::isEnabled()) {
            return null;
        }

        $lastLang = Cookie::get(self::getCookieName());

        if ($lastLang !== null) {
            return Language::tryFromCode($lastLang);
        }

        return null;
    }

    static function setLastUsedLanguage(Language $lang): void
    {
        if (
            self::isEnabled()
            && !headers_sent()
            && Cookie::get(self::getCookieName()) !== $lang->getCode()
        ) {
            Cookie::set(self::getCookieName(), $lang->getCode(), ['expires' => time() + 31536000]);
        }
    }

    private static function getCookieName(): ?string
    {
        return self::$cookieName
            ?? (self::$cookieName = MultilangPlugin::getInstance()->getConfig()['last_lang_cookie']);
    }
}
