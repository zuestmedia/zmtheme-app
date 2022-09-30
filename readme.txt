=== ZM Theme Framework ===
Contributors: zuestmedia
Version: 0.9.9
Text Domain: zmtheme

Build modular OOP WordPress Themes with ZM Theme Framework.

== Description ==

This is the core of ZM Theme Framework to build completly modular PHP OOP WordPress Themes which can be edited with ZM Plugin Template Editor and Customizer.

== Changelog ==

= 0.9.9 =
* Update: Default Blog Style updated (config files)
* Update: modPostMeta not showing empty values anymore (needs update for showing serialized data if necessary in future)

= 0.9.8 =
* New: Background Image - Options for posts featured image and external url added
* New: Add a "MY Block Patterns" folder to your child-theme
* Fix: default_config optimizations
* Fix: section_content choices

= 0.9.7 =
* Update: Language Files

= 0.9.6 =
* Remove: Colors and Gradients config files, theme.json is enough now and adds css vars to head in editor and frontend
* New: CSS Type Selection
* Update: CssVars Order

= 0.9.5 =
* Fix: Com-Type and Module labels fixed
* Update: Block Templates added assignment column

= 0.9.4 =
* New: Block Templates (CPT)
* Update: UIKIT Version 3.15.3
* Update: some configFiles
* Update: Translation Files DE
* Fix: Block Template - Widget (blocks before) confusion solved
* Fix: add alignfull / wide JS (to genereate CSS Var --scrollbar-width & --zm-wp-block-width) to head instead of zmtheme.js, to load faster and avoid window jumping
* Fix: getQueryLoop json_decode true; wp_query needs output as array

= 0.9.3 =
* Update: modQueryTerm added filter group control
* Update: modQueryTerm added filter-controll for portfolio js-filter-menu
* Added: js_array_child_theme to add custom js in child themes (via config/theme.php)

= 0.9.2 =
* Update: Tested up to: 6.0.1
* Fix: post-id and -classes to most outer container
* Update: new cssvars - navbar-dropdown-background
* Removed: ie11 Support
* Update: UIKIT Version 3.15.1
* Update: configNavMenu; uk-drop removed
* Update: MenuWalker; uk-nav-parent-icon options added
* Fix: Page and Single custom Templates available to all cpt and pages
* Fix: Taxonomies choices in Themesettings
* Update: New Display Settings-Choices & View Settings
* Update: Internationalization; separate textdomain for zm theme framework added and language string updates
* Added: de_DE translation

= 0.9.1 =
* Update: BBPress compatibilty added

= 0.9.0 =
* Initial release of ZM Theme Framework
