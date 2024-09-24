# Creative Commons - Chapter WordPress theme

- Contributors: quentinrogers, mackaffinity, cctimidrobot, hugosolar
- Tags: CreativeCommons
- Requires at least: 4.5+
- Tested up to: 5.0.3
- Requires PHP: 7.0
- License: GPLv2 or later
- License URI: https://www.gnu.org/licenses/gpl-2.0.html

Creative Commons Chapter site theme (including chapter sites setup,
taxonomies, and widget code)

## Development Installation

This theme uses npm, gulp, and browserify to manage dependencies.

Versions of node and npm we know work:

- `npm 3.3.12`
- `node 5.4.1`

To install gulp:

- run `npm install -g gulp`

To build the js/css:

- Go to the directory (cd wp-theme-cc-chapter) 
- run `npm install` to download the 3rd party libs in `package.json`
- during development:
  - run `gulp` in the background, i.e. run `gulp` in a terminal and leave it
    running. It will automatically recompile `css/app.css` files as you edit
    the src files.
- when preparing for production:
  - run `gulp dist` to create minified `css/app.css` files.
- also update the CC_CSS_RELEASE_SERIAL_NUMBER at the top of functions.php to
  purge the caches.

## Standalone installation 

### Requirements
- Composer 
- node / npm (yarn also works)
- git

Clone the repository into your `wp-content/themes`

```
> git clone git@github.com:creativecommons/wp-theme-cc-chapter.git
``` 

then, go to the directory (`cd wp-theme-cc-chapter`) and execute composer install
```
> composer install
```
Composer will install the required dependencies such as
- Queulat
- Twentysixteen

Once composer finished to install dependencies a new directory called `queulat` will be created in `wp-content/mu-plugins` 
To enable this plugin you should create a `queulat.php` file in `wp-content/mu-plugins` with the following content:
```php
<?php
/**
 * Plugin Name: Queulat Loader
 * Description: Load Queulat mu-plugin
 */

// Load Composer autoloader
require_once __DIR__ .'/../themes/wp-theme-cc-chapter/vendor/autoload.php';

// Load Queulat main file.
require_once __DIR__ .'/queulat/queulat.php';
```
*note: if you chose a different directory name for theme repository you should replace `wp-theme-cc-chapter` for the chosen directory/folder name*

Once queulat is installed, you should install its `javascript` dependencies by executing
```
> npm install --production
```
or

```
> yarn install --prod
```

## Zip install

You can download the zip of this theme and dependencies in the [last release](https://github.com/creativecommons/wp-theme-cc-chapter/releases) in the repository

Please unzip the downloaded file and copy/upload directories to the wordpress install in the following order:

- zip > `wp-theme-cc-chapter` > `mu-plugins` -> `wp-content/mu-plugins/`
- zip > `wp-theme-cc-chapter` > `themes/wp-theme-cc-chapter` -> `wp-content/themes/wp-theme-cc-chapter`
- zip > `wp-theme-cc-chapter` > `themes/twentysixteen` -> `wp-content/themes/twentysixteen`