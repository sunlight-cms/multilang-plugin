<?php

namespace SunlightExtend\Multilang;

abstract class AcceptLanguage
{
    /**
     * @return Language[] ordered by preference
     */
    static function getPreferred(): array
    {
        static $cache = null;

        if ($cache !== null) {
            return $cache;
        }

        $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;

        if (!is_string($acceptLanguage)) {
            return [];
        }

        $langs = [];

        foreach (self::parse($acceptLanguage) as $code => $q) {
            if (!Language::isValidCode($code)) {
                continue;
            }

            $langs[] = Language::fromCode($code);
        }

        return $cache = $langs;
    }

    /**
     * @return array<string, float>
     */
    private static function parse(string $acceptLanguage): array
    {
        $langs = [];

        foreach (explode(',', $acceptLanguage) as $part) {
            if (preg_match('{\h*+(?P<code>[a-z]{2})(?:-[^;]++)?(?:;q=(?P<q>0\.\d{1,3}|1|0))?\h*+$}AD', $part, $match)) {
                $langs[$match['code']] = (float) ($match['q'] ?? 1.0);
            }
        }
        
        arsort($langs, SORT_NUMERIC);

        return $langs;
    }
}
