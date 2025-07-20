<?php

use Sunlight\Core;
use SunlightExtend\Multilang\Language;
use SunlightExtend\Multilang\LanguageRoot;
use SunlightExtend\Multilang\MultilangPlugin;

return function () {
    /** @var MultilangPlugin $this */
    if (isset($_SESSION['admin_page_lister'])) {
        return; // page lister has already been initialized this session
    }

    if (!$this->getConfig()['admin_page_lister_default_page']) {
        return;
    }

    // attempt to set default current page based on the user's language
    $lang = Language::tryFromCode(Core::$langPlugin->getIsoCode());

    if ($lang === null) {
        return null;
    }

    $root = LanguageRoot::getByLanguage($lang);

    if ($root === null) {
        return;
    }

    $_SESSION['admin_page_lister'] = [
        'current_page' => $root->getId(),
    ];
};
