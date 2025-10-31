<?php
/**
 * The main template file (3-COLUMN LAYOUT CLEAN VERSION)
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php
	// === PHẦN TIÊU ĐỀ TRANG ===
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
			$archive_subtitle = __( 'We could not find any results for your search.', 'twentytwenty' );
		}
	} elseif ( is_archive() && ! have_posts() ) {
		$archive_title = __( 'Nothing Found', 'twentytwenty' );
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) :
	?>
		<header class="archive-header has-text-align-center header-footer-group">
			<div class="archive-header-inner section-inner medium">
				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php endif; ?>

				<?php if ( $archive_subtitle ) : ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text">
						<?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</header>
	<?php endif; ?>

	<?php if ( is_search() ) : ?>
		<div class="search-bar container mb-5">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label>
					<input type="search" class="search-field" placeholder="Search topics or keywords"
						value="<?php echo get_search_query(); ?>" name="s" />
				</label>
				<input type="submit" class="search-submit" value="Search" />
			</form>
		</div>
	<?php endif; ?>

	<!-- === BẮT ĐẦU BỐ CỤC 3 CỘT === -->
	<div class="homepage-three-column-layout section-inner">

		<!-- === CỘT 1: SIDEBAR TRÁI === -->
		<aside class="homepage-sidebar-left" aria-label="Sidebar trái">
			<?php if ( ! is_search() ) : ?>
				<div class="widget homepage-recent-posts">
					<h2 class="widget-title"><?php _e( 'Bài viết mới nhất', 'twentytwenty' ); ?></h2>

					<?php
					$recent_posts_query = new WP_Query(
						array(
							'posts_per_page'      => 8,
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
						)
					);

					if ( $recent_posts_query->have_posts() ) :
						echo '<ol class="recent-posts-numbered-list">';
						while ( $recent_posts_query->have_posts() ) :
							$recent_posts_query->the_post();
							echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
						endwhile;
						echo '</ol>';
						wp_reset_postdata();
					else :
						echo '<p>' . __( 'Không có bài viết nào.', 'twentytwenty' ) . '</p>';
					endif;
					?>
				</div>
			<?php else : ?>
				<div class="custom-col col-left">
					<h2 class="section-title">Trang mới nhất</h2>
					<?php
					$recent_posts = wp_get_recent_posts(
						array(
							'numberposts' => 3,
							'post_status' => 'publish',
						)
					);

					foreach ( $recent_posts as $post ) :
						$categories    = get_the_category( $post['ID'] );
						$category_name = ! empty( $categories ) ? $categories[0]->name : 'Chưa phân loại';
						?>
						<div class="latest-post-item">
							<h3 class="latest-post-heading">
								<a href="<?php echo get_permalink( $post['ID'] ); ?>">
									<?php echo esc_html( mb_strimwidth( $post['post_title'], 0, 50, '...' ) ); ?>
								</a>
							</h3>
							<a href="<?php echo get_permalink( $post['ID'] ); ?>" class="latest-post-thumbnail">
								<?php echo get_the_post_thumbnail( $post['ID'], 'large' ); ?>
							</a>
							<p class="latest-post-excerpt">
								<?php echo wp_trim_words( $post['post_content'], 25, '...' ); ?>
							</p>
							<div class="latest-post-category">Ngành: <?php echo esc_html( $category_name ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</aside>

		<!-- === CỘT 2: NỘI DUNG CHÍNH === -->
		<div class="homepage-content-center">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
			elseif ( is_search() ) :
				?>
				<div class="no-search-results-form section-inner thin">
					<?php get_search_form( array( 'aria_label' => __( 'search again', 'twentytwenty' ) ) ); ?>
				</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/pagination' ); ?>
		</div>

		<!-- === CỘT 3: SIDEBAR PHẢI === -->
		<aside class="homepage-sidebar-right" aria-label="Sidebar phải">
			<?php if ( ! is_search() ) : ?>
				<div class="widget homepage-recent-comments">
					<h2 class="widget-title"><?php _e( 'Comments', 'twentytwenty' ); ?></h2>
					<?php
					$recent_comments = get_comments(
						array(
							'number'      => 5,
							'status'      => 'approve',
							'post_status' => 'publish',
						)
					);

					if ( ! empty( $recent_comments ) ) :
						echo '<ul class="recent-comments-list">';
						foreach ( $recent_comments as $comment ) :
							echo '<li class="recent-comment-item">';
							echo '<span class="comment-author">' . get_comment_author( $comment->comment_ID ) . '</span> ';
							_e( 'viết:', 'twentytwenty' );
							echo ' <a href="' . esc_url( get_comment_link( $comment ) ) . '">' . wp_trim_words( $comment->comment_content, 7, '...' ) . '</a>';
							echo '</li>';
						endforeach;
						echo '</ul>';
					else :
						echo '<p>' . __( 'Chưa có bình luận nào.', 'twentytwenty' ) . '</p>';
					endif;
					?>
				</div>
			<?php else : ?>
				<div class="custom-col col-right">
					<div class="latest-comments-widget">
						<h3 class="section-title">Bình luận mới nhất</h3>
						<?php
						$recent_comments = get_comments(
							array(
								'number'  => 5,
								'status'  => 'approve',
								'parent'  => 0,
							)
						);

						if ( $recent_comments ) :
							?>
							<ul class="styled-comment-list">
								<?php foreach ( $recent_comments as $comment ) : ?>
									<li class="styled-comment-item">
										<div class="comment-avatar-wrap"><?php echo get_avatar( $comment, 55 ); ?></div>
										<div class="comment-body-wrap">
											<h4 class="comment-author-name"><?php echo esc_html( get_comment_author( $comment ) ); ?></h4>
											<p class="comment-text-content"><?php echo esc_html( wp_trim_words( $comment->comment_content, 35, '...' ) ); ?></p>

											<?php
											$child_comments = get_comments(
												array(
													'parent' => $comment->comment_ID,
													'status' => 'approve',
												)
											);

											if ( $child_comments ) :
												echo '<ul class="children">';
												foreach ( $child_comments as $child ) :
													?>
													<li class="styled-comment-item">
														<div class="comment-avatar-wrap"><?php echo get_avatar( $child, 45 ); ?></div>
														<div class="comment-body-wrap">
															<h4 class="comment-author-name"><?php echo esc_html( get_comment_author( $child ) ); ?></h4>
															<p class="comment-text-content"><?php echo esc_html( wp_trim_words( $child->comment_content, 30, '...' ) ); ?></p>
														</div>
													</li>
													<?php
												endforeach;
												echo '</ul>';
											endif;
											?>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</aside>

	</div>
	<!-- === KẾT THÚC BỐ CỤC 3 CỘT === -->

	<?php if ( is_search() ) : ?>
		<div class="latest-news-section section-inner">
			<h2 class="latest-news-title"><?php _e( 'Latest News', 'twentytwenty' ); ?></h2>

			<?php
			$latest_news_query = new WP_Query(
				array(
					'posts_per_page'      => 3,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
				)
			);

			if ( $latest_news_query->have_posts() ) :
				echo '<ul class="latest-news-timeline">';
				while ( $latest_news_query->have_posts() ) :
					$latest_news_query->the_post();
					?>
					<li class="news-item">
						<div class="news-content">
							<div class="news-header">
								<h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span class="news-date"><?php echo get_the_date( 'j F, Y' ); ?></span>
							</div>
							<div class="news-excerpt"><?php the_excerpt(); ?></div>
						</div>
					</li>
					<?php
				endwhile;
				echo '</ul>';
				wp_reset_postdata();
			else :
				echo '<p>' . __( 'No latest news found.', 'twentytwenty' ) . '</p>';
			endif;
			?>
		</div>
	<?php endif; ?>

</main>

<?php
get_template_part( 'template-parts/footer-menus-widgets' );
get_footer();
