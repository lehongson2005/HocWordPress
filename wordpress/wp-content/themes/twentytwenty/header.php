<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>

        <?php
        wp_body_open();
        ?>

        <header id="site-header" class="header-footer-group color-header">

            <div class="header-inner section-inner">

                <div class="header-custom-blocks-wrapper">

                    <div class="header-group-c-home">
                        <div class="header-group-c">
                            <span>Group C</span>
                        </div>
                        <div class="header-home-nav">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link active">Home</a>
                        </div>
                    </div>

                    <div class="header-search-block">
                        <div class="header-search-form">
                            <form role="search" method="get" class="search-form-custom" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <label>
                                    <input type="search" class="search-field" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" />
                                </label>
                                <input type="submit" class="search-submit" value="Submit" />
                            </form>
                        </div>
                    </div>

                    <div class="header-nav-block">

                        <?php
                        // Hiển thị menu chính (Thẻ thao, Khoa học, Tin tức...)
                        if ( has_nav_menu( 'primary' ) ) {
                            ?>
                            <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">
                                <ul class="primary-menu reset-list-style">
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'container'      => '',
                                            'items_wrap'     => '%3$s',
                                            'theme_location' => 'primary',
                                        )
                                    );
                                    ?>
                                </ul>
                            </nav><?php
                        } else {
                            // Dự phòng nếu chưa thiết lập primary menu
                            ?>
                            <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">
                                <ul class="primary-menu reset-list-style">
                                    <li><a href="#">Thể thao</a></li>
                                    <li><a href="#">Khoa học</a></li>
                                    <li><a href="#">Tin tức</a></li>
                                </ul>
                            </nav>
                            <?php
                        }

                        // Icon Menu (3 chấm)
                        ?>
                        <div class="header-menu-icon icon-item">
                            <button class="toggle nav-toggle menu-icon-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                                <span class="toggle-icon"><?php twentytwenty_the_theme_svg( 'ellipsis' ); ?></span>
                            </button>
                            <span class="menu-label">Menu</span>
                        </div>

                        <div class="header-search-icon icon-item">
                            <button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                                <?php twentytwenty_the_theme_svg( 'search' ); ?>
                            </button>
                            <span class="search-label">Search</span>
                        </div>

                    </div>

                    <div class="header-account-block icon-item">
                        <div class="header-account">
                            <?php
                            // Code kiểm tra đăng nhập và hiển thị Account/Login
                            if ( is_user_logged_in() ) {
                                ?>
                                <div class="account-icon-dropdown">
                                    <a href="#" class="account-toggle">
                                        <div class="account-icon-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="currentColor">
                                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                            </svg>
                                            <span class="account-text"><?php _e( 'Account ▼', 'twentytwenty' ); ?></span>
                                        </div>
                                    </a>
                                    <div class="account-dropdown-menu">
                                        <a href="<?php echo admin_url( 'profile.php' ); ?>"><?php _e( 'Hồ sơ của tôi', 'twentytwenty' ); ?></a>
                                        <a href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e( 'Đăng xuất (Logout)', 'twentytwenty' ); ?></a>
                                    </div>
                                </div>
                                <?php
                            } else {
                                // Chưa đăng nhập: Hiển thị link Login
                                ?>
                                <a href="<?php echo wp_login_url(); ?>" class="login-link toggle">
                                    <span class="toggle-inner">
                                        <?php twentytwenty_the_theme_svg( 'user' ); ?>
                                        <span class="toggle-text"><?php _e( 'Login', 'twentytwenty' ); ?></span>
                                    </span>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
                </div><?php
            // Output the search modal (if it is activated in the customizer).
            $enable_header_search = get_theme_mod( 'enable_header_search', true );
            if ( true === $enable_header_search ) {
                get_template_part( 'template-parts/modal-search' );
            }
            ?>

        </header><?php
        // Output the menu modal.
        get_template_part( 'template-parts/modal-menu' );
        ?>