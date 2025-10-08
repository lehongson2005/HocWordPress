<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php
	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( is_archive() && ! have_posts() ) {
		$archive_title = __( 'Nothing Found', 'twentytwenty' );
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>
		
		<?php
	}

	if ( have_posts() ) {
		$i = 0;

		while ( have_posts() ) {
			++$i;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		}
	} elseif ( is_search() ) {
		// Custom "No search results" section.
		?>
		<div class="no-search-results-wrapper">
			<div class="no-search-results-box">
				<h2>
					<?php echo sprintf( __( 'Search: %s', 'twentytwenty' ), '<span>"' . esc_html( get_search_query() ) . '"</span>' ); ?>
				</h2>
				<p>
					<?php esc_html_e( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' ); ?>
				</p>

				<div class="search-again-form">
					<?php
					get_search_form(
						array(
							'aria_label' => __( 'search again', 'twentytwenty' ),
						)
					);
					?>
				</div>
			</div>
		</div>
		<?php
	} else {
		// When no posts and not a search
		get_template_part( 'template-parts/content', 'none' );
	}
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>
