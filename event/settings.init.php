<?php

use Sunlight\Core;
use Sunlight\Settings;
use SunlightExtend\Multilang\LanguageRoot;
use SunlightExtend\Multilang\LanguageService;
use SunlightExtend\Multilang\MultilangCookie;
use SunlightExtend\Multilang\MultilangPlugin;
use SunlightExtend\Multilang\MultilangRouter;
use SunlightExtend\Multilang\MultilangState;

return function () {
    /** @var MultilangPlugin $this */

    // remember original language_allowcustom setting
    MultilangState::$userSelectionAllowed = (bool) Settings::get('language_allowcustom');

    // different behavior based on current environment
    switch (Core::$env) {
        case Core::ENV_WEB;
            MultilangState::$lang = MultilangRouter::getLanguageFromUrl();
            MultilangState::$source = MultilangState::FROM_URL;
            break;

        case Core::ENV_SCRIPT;
            MultilangState::$lang = MultilangCookie::getLastUsedLanguage();
            MultilangState::$source = MultilangState::FROM_COOKIE;
            break;

        default:
            // inactive in admin
            return;
    }

    // temporarily disable user language selection (only allowed in admin)
    Settings::overwrite('language_allowcustom', '0');

    // handle current language
    if (MultilangState::$lang !== null) {
        $config = $this->getConfig();

        // switch language if possible
        $langPlugin = LanguageService::getPluginForLanguage(MultilangState::$lang);

        if ($langPlugin !== null) {
            Settings::overwrite('language', $langPlugin->getName());
        }

        // overwrite meta data
        $useRootHeading = $config['use_root_heading'];
        $useRootDescription = $config['use_root_description'];

        if ($useRootHeading || $useRootDescription) {
            $root = LanguageRoot::getByLanguage(MultilangState::$lang);

            if ($root !== null) {
                if ($useRootHeading && $root->getHeading() !== '') {
                    Settings::overwrite('title', $root->getHeading());
                }

                if ($useRootDescription && $root->getDescription() !== '') {
                    Settings::overwrite('description', $root->getDescription());
                }
            }
        }

        // remember last used language if it came from the URL
        if (MultilangState::$source === MultilangState::FROM_URL) {
            MultilangCookie::setLastUsedLanguage(MultilangState::$lang);
        }
    }
};
