Multilang plugin
################

Plugin that helps with creation of multilingual websites.

.. contents::


Requirements
************

- PHP 7.1+
- SunLight CMS 8.3.1+


Usage
*****

This plugin adds a new "localisation" page type. Create one or more localisation pages at the root level
and the website will now dynamically switch language depending on the URL. That's it!

.. NOTE::

  The localisation pages themselves have no content (apart from title and heading).
  Navigating to them will redirect to their first subpage.


Configuration
*************

The plugin can be configured in *Administration - Plugins - Multilang - Configure*.

- **Redirect from index**

  When enabled, requests to the website's index page will be redirected to an appropriate localised index based on Accept-Language or the last used language cookie.

- **Use localisation heading**

  When enabled, use the heading of the current localisation root instead of the website title from system settings.

- **Use localisation description**

  When enabled, use the description of the current localisation root instead of the website description from system settings.

- **Filter search results**

  When enabled, only content in the current language is searched.

- **Last used language cookie**

  Store the last used language in a cookie with this name. Disabled if blank.

- **Admin - set default page**

  Set the default page in "Administration - Content management" based on the user's language.

- **Admin - show language switcher**

  Enable the quick language switcher in "Administration - Content management".


HCM modules
***********

Language selection menu
=======================

Creates a list of available languages.

::

  [hcm]multilang_menu[/hcm]

Usage in ``template.php``:

.. code:: php

  <?= Sunlight\Hcm::run('multilang_menu') ?>


Page menu
=========

Creates a page menu starting from the current localisation page.

::

  [hcm]multilang_page_menu, ord_start, ord_end, max_depth, class[/hcm]

- **ord_start** - list pages starting at this order number (can be ``null``)
- **ord_end** - list pages ending at this order number (can be ``null``)
- **max_depth** - maximum nested page levels to display (defaults to 1, can  be ``null``)
- **class** - custom class name

Usage in ``template.php``:

.. code:: php

  <?= Sunlight\Hcm::run('multilang_page_menu', [/* arguments go here */]) ?>


Current localisation page URL
=============================

Produces URL to the current localisation page.

::

  [hcm]multilang_root_url[/hcm]

Usage in ``template.php``:

.. code:: php

  <?= Sunlight\Hcm::run('multilang_root_url') ?>
