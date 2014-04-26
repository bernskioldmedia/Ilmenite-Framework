Ilmenite Framework
==================

The Ilmenite Framework is a custom theme starter framework for WordPress made by Bernskiold Media used as a base for all our themes. The framework is meant to be customized and turned into a fully customized template, removing all references to "Ilmenite Framework".

All functions that extend WordPress are organized neatly in the core/ directory through subfolders and the theme set up using a base class in core/theme.php.

The framework is currently made to be used with Foundation 5 (CSS Framework) and as such out of the box includes our customization of our workflow based on Foundation 5 by Zurb, however this can be easily changed.

## Changelog ##
You will not find references to these version numbers within the code as everything will be versioned 1.0 to make theme development faster.

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
First framework release.