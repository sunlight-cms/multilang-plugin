<?php

use Sunlight\Router;
use SunlightExtend\Multilang\Language;
use SunlightExtend\Multilang\LanguageRoot;

defined('SL_ROOT') or exit;

$lang = Language::tryFromCode($_page['slug']);

if ($lang === null || $_page['node_parent'] !== null) {
    // bad language code or not a root page
    $_index->notFound();
    return;
}

$langRoot = new LanguageRoot($_page['id'], $lang, $_page['title'], $_page['heading'], $_page['description']);
$indexPage = $langRoot->getIndex();

if ($indexPage === null) {
    // language root has no valid index subpage
    $_index->notFound();
    return;
}

$_index->redirect(Router::page($indexPage['id'], $indexPage['slug'], null, ['absolute' => true]));
