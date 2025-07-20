<?php

/** @param array{output: string} $args */
return function (array $args) {
    $args['output'] .= <<<CSS
#multilang-switcher {padding: 0.5em 1em; border-bottom: 3px double {$GLOBALS['scheme_smoke_med']}; background-color: {$GLOBALS['scheme_smoke_lightest_colored']}; font-weight: bold;}
#multilang-switcher li:first-child:after {display: none;}
#multilang-switcher a {color: {$GLOBALS['scheme_smoke_text_darker']};}
#multilang-switcher a:hover {color: {$GLOBALS['scheme_link']};}
CSS;
};
