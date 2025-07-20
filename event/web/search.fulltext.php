<?php

use Sunlight\Database\Database as DB;
use Sunlight\Search\Source\FulltextSource;
use SunlightExtend\Multilang\MultilangPlugin;
use SunlightExtend\Multilang\MultilangState;

/** @param array{source: FulltextSource, alias: string, joins: string[], filter: string[]} $args */
return function (array $args) {
    /** @var MultilangPlugin $this */
    if (MultilangState::$lang === null) {
        return;
    }

    if (!$this->getConfig()['filter_search_by_lang']) {
        return;
    }

    $alias = ($args['alias'] !== null ? $args['alias'] . '.' : '');
    $slugPattern = DB::val(MultilangState::$lang->getCode() . '/%');

    switch ($args['source']->getKey()) {
        case 'pages':
            $args['filter'][] = $alias . 'slug LIKE ' . $slugPattern;
            break;

        case 'articles':
            $args['filter'][] = '('
                . 'cat1.slug LIKE ' . $slugPattern
                . ' OR cat2.slug LIKE ' . $slugPattern
                . ' OR cat3.slug LIKE ' . $slugPattern
                . ')';
            break;

        case 'posts':
            $args['filter'][] = '('
                . 'home_page.slug LIKE ' . $slugPattern
                . 'OR home_cat1.slug LIKE ' . $slugPattern
                . ' OR home_cat2.slug LIKE ' . $slugPattern
                . ' OR home_cat3.slug LIKE ' . $slugPattern
                . ')';
            break;

        case 'images':
            $args['filter'][] = 'gal.slug LIKE ' . $slugPattern;
            break;
    }
};
