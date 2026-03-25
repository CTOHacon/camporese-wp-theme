<?php

use Hacon\ThemeCore\Services\TemplatingService\ComponentRenderService;
use Hacon\ThemeCore\ThemeModules\ACF\ACF;
use Hacon\ThemeCore\ThemeModules\GutenbergBlocksWhitelist\GutenbergBlocksWhitelist;
use Hacon\ThemeCore\ThemeModules\Polylang\Polylang;
use Hacon\ThemeCore\ThemeModules\ThemeAssetsLoader\ThemeAssetsLoader;
use Hacon\ThemeCore\ThemeModules\BodyWidthCssComputedVariable\BodyWidthCssComputedVariable;
use Hacon\ThemeCore\ThemeModules\DocumentScrollbarWidthCssVariable\DocumentScrollbarWidthCssVariable;
use Hacon\ThemeCore\ThemeModules\FormOrdersPostType\FormOrdersPostType;
use Hacon\ThemeCore\ThemeModules\InternalNavigationPrefetch\InternalNavigationPrefetch;
use Hacon\ThemeCore\ThemeModules\PageAutoTableOfContetns\PageAutoTableOfContetns;
use Hacon\ThemeCore\ThemeModules\PreventOnLoadCssTransitions\PreventOnLoadCssTransitions;
use Hacon\ThemeCore\ThemeModules\ReCaptcha\ReCaptcha;
use Hacon\ThemeCore\ThemeModules\ScrollSaver\ScrollSaver;
use Hacon\ThemeCore\ThemeModules\PathPatternCache\PathPatternCache;
use Hacon\ThemeCore\ThemeModules\Seeders\Seeders;

require_once 'vendor/autoload.php';

/**
 * Handle the WordPress Defaults
 */

disableComments();
disableWpEmoji();
disablePostsPostType();

/**
 * Check ACF is active. Critical for the theme functionality
 */
if (!function_exists('acf_add_options_page')) {
    // show admin notice
    add_action('admin_notices', function () {
        echo '<div class="error"><p><strong>Advanced Custom Fields Pro</strong> plugin is required for the theme to function properly. Please install and activate it.</p></div>';
    });
    return;
}

/**
 * Init assets
 */
ThemeAssetsLoader::initModule(getThemeСonfig('assets'));

/**
 * Configure Components Render Service
 */
ComponentRenderService::defineDomain('default', getThemeСonfig('components.base'));

requireAll(path_join(getThemeСonfig('components.base'), '**/*.includes.php'));

/**
 * Polylang for internacionalization (Optional)
 */
Polylang::initModule(getThemeСonfig('polylang'));

/**
 * ACF (Core functionality)
 */
ACF::initModule(getThemeСonfig('acf'));

/**
 * Body Width CSS Computed Variable
 * 
 * --body-width
 */
BodyWidthCssComputedVariable::initModule();

/**
 * Document Scrollbar Width CSS Variable
 */
DocumentScrollbarWidthCssVariable::initModule();

/**
 * Form Orders Post Type
 */
FormOrdersPostType::initModule([]);

/**
 * Internal Navigation Prefetch
 */
InternalNavigationPrefetch::initModule();

/**
 * Page Auto Table Of Contents
 */
PageAutoTableOfContetns::initModule([]);

/**
 * Prevent On Load CSS Transitions
 */
PreventOnLoadCssTransitions::initModule();

/**
 * ReCaptcha
 */
ReCaptcha::initModule(getThemeСonfig('recaptcha'));

/**
 * Scroll Saver
 */
ScrollSaver::initModule();

/**
 * Path Pattern Cache
 */
PathPatternCache::initModule();

/**
 * Seeders Module
 */
Seeders::initModule();
requireAll('seeders/*.php');

/**
 * Other Core Includes
 */
requireAll('includes/*.php');

/**
 * 
 */
GutenbergBlocksWhitelist::initModule([
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/list-item',
    'core/table',
    'acf/*'
]);