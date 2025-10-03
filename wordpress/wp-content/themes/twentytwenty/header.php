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
<style>
	.site-branding {
    display: flex;
    align-items: center;  /* căn giữa theo chiều dọc */
    gap: 12px;            /* khoảng cách giữa logo và slogan */
}


.site-description-wrapper {
    background: #000000ff; /* nền slogan */
    padding: 6px 12px;
    font-size: 14px;
    color: #333;
}

		/* ===== Header tổng thể ===== */
#site-header {
    background: #bcb9b9ff !important; /* màu nền sáng */
    color: #000000ff !important;
    border-bottom: 1px solid #ddd; /* viền mảnh dưới */
    padding: 6px 20px;
}
.site-description-wrapper{
	background-color: #454040ff !important;
}

/* ===== Layout flex ===== */
.header-inner.section-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

/* Logo + tên site */
.header-titles-wrapper {
    display: flex;
    align-items: center;
    gap: 20px;
    flex: 0 0 auto;
}

/* ===== Menu chính ===== */
.primary-menu-wrapper {
    flex: 1;
    display: flex;
    justify-content: center;
}

.primary-menu-wrapper .primary-menu {
    display: flex;
    gap: 20px;
    align-items: center;
}

.primary-menu-wrapper .primary-menu li a {
    color: #444;
    text-decoration: none;
    font-size: 15px;
    padding: 6px 10px;
    border-radius: 4px;
    transition: background 0.2s ease, color 0.2s ease;
}

.primary-menu-wrapper .primary-menu li a:hover {
    background: #eee;
    color: #000;
}

/* ===== Search box ===== */
.search-box {
    margin-left: 80px;
}

/* Search box tách input và button */
.search-box form {
    display: flex;
    align-items: center;
    gap: 10px; /* tạo khoảng cách giữa input và button */
}

.search-box input[type="text"] {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 6px 10px;
    font-size: 14px;
    outline: none;
    width: 240px;
}

.search-box button {
    border: 1px solid #ccc;
    border-radius: 4px;
    background: #f2f2f2;
    padding: 6px 12px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s ease;
}

.search-box button:hover {
    background: #e6e6e6;
}


/* ===== Nhóm toggles bên phải ===== */
.header-navigation-wrapper {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* Icon Menu / Search / Account */
.header-toggles .toggle,
.account-toggle {
    background: transparent;
    border: none;
    cursor: pointer;
    color: #444;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s ease;
}

.header-toggles .toggle:hover,
.account-toggle:hover {
    color: #000;
}

.toggle .toggle-icon svg {
    width: 18px;
    height: 18px;
    fill: currentColor;
}

/* ===== Account dropdown arrow ===== */
.account-toggle .dropdown-arrow {
    font-size: 12px;
}

/* ===== Responsive ===== */
@media (max-width: 900px) {
    .search-box {
        display: none;
    }
    .primary-menu-wrapper {
        display: none;
    }
}

	</style>
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

				<div class="header-titles-wrapper">

					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php twentytwenty_the_theme_svg( 'searchx' ); ?>
								</span>
								<span class="toggle-text"><?php _ex( 'Searchzzz', 'toggle text', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .search-toggle -->

					<?php } ?>

					<div class="header-titles">

						<div class="site-branding">

    <!-- Logo riêng -->
    <div class="site-logo-wrapper">
        <?php twentytwenty_site_logo(); ?>
    </div>

    <!-- Description riêng -->
    <div class="site-description-wrapper">
        <?php twentytwenty_site_description(); ?>
    </div>

</div>


					</div><!-- .header-titles -->

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->


				<div class="search-box">
    <form action="/" method="get">
        <input type="text" name="s" placeholder="Search" />
        <button type="submit">Submit</button>
    </form>
</div>



				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<div class="toggle-wrapper search-toggle-wrapper color-header">

								<button class="toggle search-toggle desktop-search-toggle color-header" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php twentytwenty_the_theme_svg( 'search' ); ?>
										<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

							<?php
						}
						?>


						</div><!-- .header-toggles -->
						<div class="toggle-wrapper account-toggle-wrapper">
    <a class="toggle account-toggle" href="<?php echo wp_login_url(); ?>">
        <span class="toggle-inner">
            <?php twentytwenty_the_theme_svg( 'user' ); ?>
            <span class="toggle-text">Account</span>
            <span class="dropdown-arrow">▼</span>
        </span>
    </a>
</div>

						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

		</header><!-- #site-header -->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );


