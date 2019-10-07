<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/favicon.ico" type="image/x-icon">
            <link rel="icon" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon/favicon.ico" type="image/x-icon">
        
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory') ?>/images/favicon/ms-icon-144x144.png">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <div class="site-inner">
        <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>
        <div class="site-header-wrapper">
            <header id="masthead" class="site-header sticky-nav-main" role="banner">
                    <!-- <div class="site-branding-wrapper"> -->
                    <div class="site-header-main">
                        <div class="site-header-top-wrapper">
                            <div class="site-branding">
                                <a class="cc-site-logo-link" id="logo" href="<?php echo home_url( '/' ); ?>" rel="home">
                                    <img class="cc-site-logo" alt="Creative Commons" width="303" height="72" src="<?php echo get_stylesheet_directory_uri() . '/images/cc.logo.white.svg'; ?>">
                                </a>
                                <span class="country_id">
                                    <?php
                                    global $_set;
                                    $settings = $_set->settings;
                                    if ( get_option( 'country_code' ) && (!$settings['hide_flag']) ) {
                                        print do_shortcode( '<span class="flag c_' . strtolower( get_option( 'country_code' ) ) . '"></span>' ); }
                                    ?>
                                  <span class="name"><?php print get_bloginfo( 'name' ); ?></span>
                                </span>
                            </div>
                            <div class="header-right-col">
                                <?php get_template_part( 'template-parts/sidebar/sidebar','header-widget' ); ?>
                                <?php if ( has_nav_menu( 'secondary' ) ) : ?>
                                <nav	 id="secondary-navigation" class="secondary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Secondary Menu' ); ?>">
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'secondary',
                                                'menu_class' => 'secondary-menu',
                                            )
                                        );
                                    ?>
                                </nav><!-- .main-navigation -->
                            <?php endif; ?>
                            </div>
                        <?php if ( has_nav_menu( 'social' ) ) : ?>
                            <nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
                                <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'social',
                                            'menu_class'  => 'social-links-menu',
                                            'depth'       => 1,
                                            'link_before' => '<span class="screen-reader-text">',
                                            'link_after'  => '</span>',
                                        )
                                    );
                                ?>
                            </nav><!-- .social-navigation -->
                        <?php endif; ?>
                        <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : ?>
                        <button id="menu-toggle" class="menu-toggle"><i class="cc-icon-menu"></i> <span><?php _e( 'Menu', 'twentysixteen' ); ?></span></button><?php endif; ?>
                    </div>	
                </div>
                <div class="site-menu-wrapper">
                    <div class="site-menu-main">
                    <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : ?>
                        <!-- <button id="menu-toggle" class="menu-toggle"><i class="cc-icon-menu"></i> <span><?php _e( 'Menu', 'twentysixteen' ); ?></span></button>-->

                        <div id="site-header-menu" class="site-header-menu">
                            <?php if ( has_nav_menu( 'mobile' ) ) : ?>
                                <nav id="mobile-navigation" class="mobile-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'twentysixteen' ); ?>">
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'mobile',
                                                'menu_class' => 'mobile-menu',
                                            )
                                        );
                                    ?>
                                </nav><!-- .main-navigation -->
                            <?php endif; ?>

                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'primary',
                                                'menu_class' => 'primary-menu',
                                            )
                                        );
                                    ?>
                                </nav><!-- .main-navigation -->
                            <?php endif; ?>

                            

                            
                        </div><!-- .site-header-menu -->
                    <?php endif; ?>				
                    </div>
                </div>

                <?php if ( get_header_image() ) : ?>
                    <?php
                        /**
                         * Filter the default twentysixteen custom header sizes attribute.
                         *
                         * @since Twenty Sixteen 1.0
                         *
                         * @param string $custom_header_sizes sizes attribute
                         * for Custom Header. Default '(max-width: 709px) 85vw,
                         * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
                         */
                        $custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
                    ?>
                    <div class="header-image">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        </a>
                    </div><!-- .header-image -->
                <?php endif; // End header image check. ?>
            </header><!-- .site-header -->
        </div><!-- .site-header-wrapper -->

        <div id="content" class="site-content">
