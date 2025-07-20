<?php

namespace SunlightExtend\Multilang;

use Sunlight\Core;
use Sunlight\Plugin\LanguagePlugin;
use Sunlight\Settings;

abstract class LanguageService
{
    static function getDefault(): ?Language
    {
        $plugins = Core::$pluginManager->getPlugins();
        $defaultLang = $plugins->getLanguage(Settings::get('language'))
            ?? $plugins->getLanguage(Core::$fallbackLang);

        if ($defaultLang !== null) {
            return Language::tryFromCode($defaultLang->getIsoCode());
        }

        return null;
    }

    /**
     * @return LanguagePlugin[]
     */
    static function getValidPlugins(): array
    {
        $langPlugins = [];

        foreach (Core::$pluginManager->getPlugins()->getLanguages() as $langPlugin) {
            if (Language::isValidCode($langPlugin->getIsoCode())) {
                $langPlugins[] = $langPlugin;
            }
        }

        return $langPlugins;
    }

    static function getPluginForLanguage(Language $lang): ?LanguagePlugin
    {
        $code = $lang->getCode();

        foreach (Core::$pluginManager->getPlugins()->getLanguages() as $langPlugin) {
            if ($langPlugin->getIsoCode() === $code) {
                return $langPlugin;
            }
        }

        return null;
    }
}
