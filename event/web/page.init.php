<?php

use Sunlight\WebState;
use SunlightExtend\Multilang\LanguageGuesser;
use SunlightExtend\Multilang\LanguageRoot;
use SunlightExtend\Multilang\MultilangPlugin;

/** @param array{index: WebState, segments: string[]} $args */
return function (array $args) {
    /** @var MultilangPlugin $this */
    if (!empty($args['segments'])) {
        return;
    }

    if (!$this->getConfig()['redirect_index']) {
        return;
    }

    if (empty(LanguageRoot::all())) {
        // no roots exist - do nothing
        return;
    }

    // redirect to the best root from main site index ("/")
    $root = LanguageGuesser::guessBestRoot();

    if ($root === null) {
        $args['index']->notFound();
        return;
    }

    $args['index']->redirect($root->getIndexUrl(['absolute' => true]));
};
