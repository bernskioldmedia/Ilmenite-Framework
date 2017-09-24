# Ilmenite Framework

The Ilmenite Framework is a custom theme starter framework for WordPress made by Bernskiold Media used as a base for all our themes. The framework is meant to be customized and turned into a fully customized template, removing all references to "Ilmenite Framework".

All functions that extend WordPress are organized neatly in the includes/ directory through subfolders and the theme set up using a base class in includes/theme.php.

The framework is currently made to be used with Foundation 6 (CSS Framework) and as such out of the box includes our customization of our workflow based on Foundation 6 by Zurb, however this can be easily changed.

## Getting Started
To get started with this starter theme, follow this checklist to turn it into your own:

1. Update style.css with your own information.
2. Update package.json with your own information.
3. Update bower.json with your own information.
4. Replace `THEMETEXTDOMAIN` across the theme with your own textdomain.
5. Replace the namespace `BernskioldMedia\ClientName\Theme` with your own namespace across the whole theme.
6. Replace the theme class and init function `Ilmenite` with your own theme name.
6. Initialize node via `npm install`
7. Run Gulp using `gulp watch`
8. Open the main.js file under `assets/js/src/main.js` and save it to generate the minified JS files.
9. Open the main.scss file in `assets/scss/main.scss`.

And that's it. You're ready to work!

## Changelog
You will not find references to these version numbers within the code as everything will be versioned 1.0 to make theme development faster.

**Version 2.2**
* Added tons of new helper CSS classes
* Updated video embed to use the new Foundation video embed
* Removed included block grid structure
* Removed mostly unused scripts & styles
* Load more theme data from style.css

**Version 2.1**
* Updated Foundation version to 6.3.1

**Version 2.0**
* Reengineered the entire structure to use an OOP, class-based approach.
* Updated Foundation
* Added bower.json
* Fixed

**Version 1.5**
* Updated Foundation
* Updated package.json
* Update Node JS modules
* Added grunt pot generation
* Add po2mo grunt task
* Add textdomain check task
* Add imagemin grunt task
* Add newer grunt task
* Update to Foundation 4.2.0
* Bug fixes and tweaks

**Version 1.4**
* Added Gruntfile and package.json to add Grunt support
* Introduced and changed default variables in _settings.scss
* Updated Font Awesome to 4.1.0
* Changed sass folder name to scss
* Updated .gitignore
* Updated Foundation

**Version 1.3**
* Changed file structure for cleaner theme
* Added Foundation 5
* Renamed head.php to scripts-styles.php to reflect function
* Renamed xld-blog-rss dashboard widget to general agency rss
* Remove all "Ilmenite Framework" file headers
* Added cleanup functions file to remove various bloatware and do some tweaks
* Added support for /search/ instead of ?s= for search URLs
* Added framework for transient queries
* Updated the ilmenite_pagination function to support Foundation 5
* Added custom excerpt function
* Removed unused common functions, replaced with a placeholder empty file
* Moved sidebar registration to its own file
* Restructured the main theme load class for clarity
* Added HTML5 support (from WP 3.9)

**Version 1.2**
- Removed Foundation 4 files. These should be dropped in when starting development.
* Reset all @version references to 1.0
+ Added footer.php for functions to hook into wp_footer
* Changed formatting in head.php to be clearer.
* Changed the files included via head.php to suit our updated workflow.
+ Added scripts.js file that initializes foundation.
+ Added "Open External Links in new Window" jQuery script in scripts.js
* Moved page templates to page-templates/ folder.
+ Added frontpage base page template.
+ Added editor-style.css styles to load from layout.css

**Version 1.0**
* First framework release.