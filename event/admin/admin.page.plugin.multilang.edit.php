<?php

use Sunlight\Extend;
use Sunlight\Message;
use Sunlight\Util\Form;
use Sunlight\Util\Request;
use SunlightExtend\Multilang\Language;
use SunlightExtend\Multilang\LanguageRoot;
use SunlightExtend\Multilang\LanguageService;

/** @param array{page: array, new: bool, custom_settings: string, custom_save_array: array} $args */
return function (array $args ) {
    $page = $args['page'];
    $new = $args['new'];

    // configure editscript
    $GLOBALS['editscript_enable_content'] = false;
    $GLOBALS['editscript_enable_perex'] = false;
    $GLOBALS['editscript_enable_show_heading'] = false;
    $GLOBALS['editscript_enable_events'] = false;

    // change initial data
    if ($args['new']) {
        $GLOBALS['query']['title'] = '';
    }

    // custom saving logic
    if (!empty($_POST)) {
        $post_slug = Request::post('slug');
        $post_title = Request::post('title');

        if ($post_title === '' && Language::isValidCode($post_slug)) {
            $_POST['title'] = Language::fromCode($post_slug)->getTitle();
        }
    }

    // turn slug input into a language code select
    $in_page_form = false;

    Extend::reg('form.start', function (array $args) use (&$in_page_form) {
        $in_page_form = ($args['name'] === 'content-edit');
    });

    Extend::reg('form.start.after', function (array $args) use ($page, $new, &$in_page_form) {
        if ($in_page_form && !$new) {
            $validation_errors = LanguageRoot::validate($page);

            if (!empty($validation_errors)) {
                $args['output'] .= Message::list($validation_errors, ['text' => _lang('multilang.invalid_root') . '!']);
            }
        }
    });

    Extend::reg('form.end', function () use (&$in_page_form) {
        $in_page_form = false;
    });

    Extend::reg('form.input', function (array $args) use (&$in_page_form) {
        if (!$in_page_form) {
            return;
        }

        if ($args['name'] === 'slug') {
            $available_label = _lang('multilang.available_langs');
            $other_label = _lang('global.other');

            $lang_choices = [];

            foreach (LanguageService::getValidPlugins() as $langPlugin) {
                $code = $langPlugin->getIsoCode();
                $lang_choices[$available_label][$code] = Language::CODES[$code] . " ({$code})";
            }

            foreach (Language::CODES as $code => $title) {
                if (!isset($lang_choices[$available_label][$code])) {
                    $lang_choices[$other_label][$code] = "$title ({$code})";
                }
            }

            $args['output'] = Form::select('slug', $lang_choices, $args['value'], $args['attrs']);
        }
    });
};
