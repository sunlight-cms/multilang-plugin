<?php

use Sunlight\Core;
use SunlightExtend\Multilang\LanguageRoot;
use SunlightExtend\Multilang\MultilangPlugin;

/** @param array{output: string} $args */
return function (array $args) {
    /** @var MultilangPlugin $this */
    if (!$this->getConfig()['admin_page_lister_switcher']) {
        return;
    }

    $roots = LanguageRoot::all();

    if (empty($roots)) {
        return;
    }

    $args['output'] = _buffer(function () use ($roots) { ?>
        <ul id="multilang-switcher" class="inline-list">
            <li><?= _lang('global.language') ?>:</li>
            <?php foreach ($roots as $root):
                $url = Core::getCurrentUrl();
                $url->set('page_id', $root->getId());
            ?>
                <li class="lang-<?= _e($root->getLang()) ?>">
                    <a href="<?= _e($url->buildRelative()) ?>" title="<?= _e($root->getLang()->getTitle()) ?>">
                        <?= $root->getTitle() ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    <?php });
};
