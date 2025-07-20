<?php

namespace SunlightExtend\Multilang;

use Sunlight\Plugin\Action\ConfigAction as BaseConfigAction;
use Sunlight\Util\Form;

class ConfigAction extends BaseConfigAction
{
    protected function getFields(): array
    {
        $config = $this->plugin->getConfig();

        return [
            'redirect_index' => [
                'label' => '<label for="plugin_config_redirect_index">' . _lang('multilang.config.redirect_index') . '</label>',
                'input' => Form::input(
                    'checkbox',
                    'config[redirect_index]',
                    '1',
                    ['id' => 'plugin_config_redirect_index', 'checked' => $config['redirect_index']]
                ) . '<p class="note">' . _lang('multilang.config.redirect_index.help') . '</p>',
                'type' => 'checkbox',
            ],
            'use_root_heading' => [
                'label' => '<label for="plugin_config_use_root_heading">' . _lang('multilang.config.use_root_heading') . '</label>',
                'input' => Form::input(
                        'checkbox',
                        'config[use_root_heading]',
                        '1',
                        ['id' => 'plugin_config_use_root_heading', 'checked' => $config['use_root_heading']]
                    ) . '<p class="note">' . _lang('multilang.config.use_root_heading.help') . '</p>',
                'type' => 'checkbox',
            ],
            'use_root_description' => [
                'label' => '<label for="plugin_config_use_root_description">' . _lang('multilang.config.use_root_description') . '</label>',
                'input' => Form::input(
                        'checkbox',
                        'config[use_root_description]',
                        '1',
                        ['id' => 'plugin_config_use_root_description', 'checked' => $config['use_root_description']]
                    ) . '<p class="note">' . _lang('multilang.config.use_root_description.help') . '</p>',
                'type' => 'checkbox',
            ],
            'filter_search_by_lang' => [
                'label' => '<label for="plugin_config_filter_search_by_lang">' . _lang('multilang.config.filter_search_by_lang') . '</label>',
                'input' => Form::input(
                        'checkbox',
                        'config[filter_search_by_lang]',
                        '1',
                        ['id' => 'plugin_config_filter_search_by_lang', 'checked' => $config['filter_search_by_lang']]
                    ) . '<p class="note">' . _lang('multilang.config.filter_search_by_lang.help') . '</p>',
                'type' => 'checkbox',
            ],
            'last_lang_cookie' => [
                'label' => '<label for="plugin_config_last_lang_cookie">' . _lang('multilang.config.last_lang_cookie') . '</label>',
                'input' => Form::input(
                        'text',
                        'config[last_lang_cookie]',
                        $config['last_lang_cookie'],
                        ['id' => 'plugin_config_last_lang_cookie']
                    ) . '<p class="note">' . _lang('multilang.config.last_lang_cookie.help') . '</p>',
                'type' => 'text',
            ],
            'admin_page_lister_default_page' => [
                'label' => '<label for="plugin_config_admin_page_lister_default_page">' . _lang('multilang.config.admin_page_lister_default_page') . '</label>',
                'input' => Form::input(
                        'checkbox',
                        'config[admin_page_lister_default_page]',
                        '1',
                        ['id' => 'plugin_config_admin_page_lister_default_page', 'checked' => $config['admin_page_lister_default_page']]
                    ) . '<p class="note">' . _lang('multilang.config.admin_page_lister_default_page.help') . '</p>',
                'type' => 'checkbox',
            ],
            'admin_page_lister_switcher' => [
                'label' => '<label for="plugin_config_admin_page_lister_switcher">' . _lang('multilang.config.admin_page_lister_switcher') . '</label>',
                'input' => Form::input(
                    'checkbox',
                    'config[admin_page_lister_switcher]',
                    '1',
                    ['id' => 'plugin_config_admin_page_lister_switcher', 'checked' => $config['admin_page_lister_switcher']]
                ) . '<p class="note">' . _lang('multilang.config.admin_page_lister_switcher.help') . '</p>',
                'type' => 'checkbox',
            ],
        ];
    }
}
