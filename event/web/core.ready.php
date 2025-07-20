<?php

use Sunlight\Settings;
use SunlightExtend\Multilang\MultilangState;

return function () {
    // custom language selection
    if (MultilangState::$userSelectionAllowed) {
        // if this setting was originally enabled, re-enable it so that it still shows up in user settings
        Settings::overwrite('language_allowcustom', '1');
    }
};
