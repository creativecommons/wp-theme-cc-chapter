=== Creative Commons - Chapter WordPress theme ===
Contributors: Quentin Rogers, Dale McGladdery, cctimidrobot, hugosolar
Tags: CreativeCommons
Requires at least: 4.5+
Tested up to: 5.0.3
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Creative Commons Chapter site theme (including chapter sites setup,
taxonomies, and widget code)

== Installation ==

This theme uses npm, gulp, and browserify to manage dependencies.

Versions of node and npm we know work:

- `npm 3.3.12`
- `node 5.4.1`

To install gulp:

- run `npm install -g gulp`

To build the js/css:

- run `npm install` to download the 3rd party libs in `package.json`
- during development:
  - run `gulp` in the background, i.e. run `gulp` in a terminal and leave it
    running. It will automatically recompile `css/app.css` files as you edit
    the src files.
- when preparing for production:
  - run `gulp dist` to create minified `css/app.css` files.
- also update the CC_CSS_RELEASE_SERIAL_NUMBER at the top of functions.php to
  purge the caches.
