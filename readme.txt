=== ZMTheme Framework ===
Contributors: zuestmedia
Version: 1.1.0
Text Domain: zmtheme

Build modular OOP WordPress Themes with ZuestMedia-Theme-Framework.

== Description ==

This is the core of the ZuestMedia-Theme-Framework to build completly modular WordPress Themes, which can be edited with ZMPlugin Template-Editor and Customizer.

== Changelog ==

= 1.1.0 =
* Update: Version to 1.1
* Remove: AjaxPostsLoader2 and zmtheme2.js
* Remove: rotating class & js
* Remove: js social buttons script

= 1.0.25 =
* Update: Default container width is now 1200px like in blockeditor
* Fix: in navsearch autofocus off is by default = 2 
* Fix: Only default Menu is overflow auto

= 1.0.24 =
* Fix: Add uk-overflow-auto to NavMenu navbar, so no overlap on large menu
* Fix: Gradient Background in Editor

= 1.0.23 =
* Fix: automatically load child themes version for child style.css and child js scripts comming with child theme in config/theme/theme.php
* Fix: PHP 8.1 strpos & str_replace fixed "Passing null to parameter"

= 1.0.22 =
* New: Child Theme Css and Js/Icons options added to use via theme config file
* Update: uikit 3.1.25 update of uk-nav-search classes
* Fix: #[\AllowDynamicProperties] where necessary
* Test: added zmtheme2.js and AjaxPostsLoader2.php test file to start tests without jquery

= 1.0.21 =
* New: Theme setting added to asign template modules by page_ids (view.php)

= 1.0.20 =
* Fix: UIKIT update need new classes uk-navbar-container uk-navbar-transparent in navbar container to calculate new drop position

= 1.0.19 =
* New: Adds data privacy checkbox to comments form, if a page is set in settings/privacy
* Fix: In navbar use uk-button-link not text

= 1.0.18 =
* Update: Accesibility fix Render.php - added aria-hidden to ajax loading button icon 
* Update: Accesibility fix modMenu - add "Open menu" to dropdown navbar_dropdown_nav
* Update: Accessiblity fix zmtheme.js - adds aria-hidden to uk-close svg icon
* Update: Accesibility fixes in configNavMenu, configNavSearch, configNavToggle & configOffcanvasContainer
* Update: use pagination by default, ajax posts loading is an option

= 1.0.17 =
* Update: View / display settings updated -> loggedin: as single condition valid for all pages / if has other conditions than loggedin, loggedin valid only together with other conditions 
* Remove: section_offcanvas is not anymore set by default

= 1.0.16 =
* Update: View / display settings updated -> "hide if" display conditions added

= 1.0.15 =
* Fix: small fixes on AJAX Posts Loading Script and fallback nav only shown in archives
* Remove: pagination module for archives is now optionally available but not by default activated (replaced by ajax posts loading)

= 1.0.14 =
* New: AJAX Posts Loading in default WP Query and Custom Queries in section and module

= 1.0.13 =
* Fix: modSearch accessibility button search & close fixed in new dropdown mode

= 1.0.12 =
* New: NavbarDropdownNav as default mobile menu
* Fix: uk-nav- / uk-navbar- / uk-drop-  -parent-icon
* Fix: ArticleContainer singular (div) and posts (article)
* Update: default_templates _offcanvas (remove modules due to new mobile menu), _singular (articlecontainer), _posts (articlecontainer)
 
= 1.0.11 =
* Fix: default_config nav and navbar components updated due to uikit update to 3.16.17 (uk-navbar-item & dropdown)
* Fix: View status check conditions added
* Fix: Navbar parent icon
* Fix: Config check is_object added

= 1.0.10 =
* Fix: load child textdomain if is child theme 

= 1.0.9 =
* Update: prepared for PHP 9; defined all dynamic properties in classes

= 1.0.8 =
* Fix: Minor Bug fixes

= 1.0.7 =
* Fix: ThemeJSON Gradient Color mix-up fixed
* Fix: Escaping modErrorpage -> $text_html corrected

= 1.0.6 =
* Fix: Escaping LATEST possible before output in app/modules (getModule())

= 1.0.5 =
* Fix: escape functions added/updated CommentWalker, ThemeJSON, modCommentsCounter, modCommentsList
* Removed: Skewy

= 1.0.4 =
* New: ArticleContainer imageoverlay -wrap and -size args added and new module function to display overlays
* Fix: Element -> wraps with hr or img need close:false, so no closing tag is added (ContainerArticleList, Commentspagination)

= 1.0.3 =
* Update: CommentWalker
* Remove: BlockPatterns.php
* Update: Helpers.php - move functions to ZMPlugin
* Update: TranslationStrings for submodule translations of zmtheme-app (git-submodule)
* Update: MenuWalker Accessibility & added Subtitle (Menu Description)
* Update: Only one Textdomain!
* New: ThemeJSON class -> update theme.json programmatically with pallette and gradient colors
* Update: Accessibility & Textstrings (Translations) updated mod and config of Authorbox, Autorlink, CommentsCounter, CommentsForms, ...
* Update: Accessibility CSSVars Colors
* Update: Templates - offcanvas below menu, taxonomy cat moved to top


= 1.0.2 =
* Update: add icons via class with MenuWalker (nav-menus)
* Update: Language Files de_DE
* Fix: Text-Domain Strings
* Removed: Moved Custom Post Type for Block Templates to zmplugin

= 1.0.1 =
* Fix: configContainer & configContainerArticleList remove module_inner_attrs hr, but added option in presets

= 1.0.0 =
* Update: Language Files
* Update: Comments mod, walker & config
* Update: configImage - remove posts caption
* Update: Authorbox/Commentslist -> Avatarsize & Class Options added & style update (border-circle)
* Remove: Starter Content
* Update: Errormenu text & link to zmplugin download
* Update: accesibility - skip to content link, html5 tags (header, main, footer), aria-label search, screen-reader-text to read-more, underline all content-links

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
