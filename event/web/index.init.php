<?php

use Sunlight\Router;
use Sunlight\Util\Response;
use Sunlight\WebState;
use SunlightExtend\Multilang\LanguageGuesser;

/** @param array{index: WebState} $args */
return function (array $args) {
    $slug = $args['index']->slug;

    if ($slug !== null) {
        if (preg_match('{[a-z]{2}/(m/.++$)}A', $slug, $match)) {
            // a hacky way to allow /<lang>/m/<module> to work
            $args['index']->slug = $match[1];
        } elseif (strncmp($slug, 'm/', 2) === 0) {
            // redirect /m/<module> to /<lang>/m/<module> if possible
            $root = LanguageGuesser::guessBestRoot();

            if ($root !== null) {
                Response::redirect(Router::slug($root->getLang()->getCode() . '/' . $slug));
                exit;
            }
        }
    }
};
