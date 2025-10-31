<?php
/**
 * The main template file (MODIFIED FOR 3-COLUMN LAYOUT)
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

    <?php
    // --- Phần Tiêu đề Trang (Giữ nguyên từ code của bạn) ---
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
            $archive_subtitle = sprintf( /* ... (code gốc) ... */ );
        } else {
            $archive_subtitle = __( 'We could not find any results for your search.', 'twentytwenty' );
        }
    } elseif ( is_archive() && ! have_posts() ) {
        $archive_title = __( 'Nothing Found', 'twentytwenty' );
    } elseif ( ! is_home() ) {
        $archive_title    = get_the_archive_title();
        $archive_subtitle = get_the_archive_description();
    }

    if ( $archive_title || $archive_subtitle ) {
        ?>
        <header class="archive-header has-text-align-center header-footer-group">
            <div class="archive-header-inner section-inner medium">
                <?php if ( $archive_title ) { ?>
                    <h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
                <?php } ?>
                <?php if ( $archive_subtitle ) { ?>
                    <div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
                <?php } ?>
            </div>
        </header>
        <?php
    }
    // --- Kết thúc phần Tiêu đề Trang ---
    ?>

    <!-- ===== BẮT ĐẦU CONTAINER 3 CỘT ===== -->
    <div class="homepage-three-column-layout section-inner">

        <!-- ===== CỘT 1: BÀI VIẾT MỚI NHẤT ===== -->
        <aside class="homepage-sidebar-left" aria-label="Bài viết mới nhất">
            <div class="widget homepage-recent-posts">
                <h2 class="widget-title">
                    <?php _e( 'Bài viết mới nhất', 'twentytwenty' ); ?>
                </h2>
                
                <?php
                // Query lấy 8 bài viết mới nhất
                $recent_posts_query = new WP_Query( array(
                    'posts_per_page'      => 8,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => 1,
                ) );

                if ( $recent_posts_query->have_posts() ) : 
                ?>
                    <ol class="recent-posts-numbered-list">
                        <?php
                        while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
                        ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </ol>
                <?php else : ?>
                    <p><?php _e( 'Không có bài viết nào.', 'twentytwenty' ); ?></p>
                <?php endif; ?>

                <?php
                // Fallback nếu bạn muốn dùng Widget Area sau này
                // if ( is_active_sidebar( 'homepage-left-sidebar' ) ) {
                //     dynamic_sidebar( 'homepage-left-sidebar' );
                // }
                ?>
            </div>
        </aside>

        <!-- ===== CỘT 2: DANH SÁCH BÀI VIẾT CHÍNH (Vòng lặp gốc) ===== -->
        <div class="homepage-content-center">
            <?php
            // --- Code gốc của bạn cho vòng lặp chính ---
            if ( have_posts() ) {
                $i = 0;
                while ( have_posts() ) {
                    ++$i;
                    if ( $i > 1 ) {
                        // echo ''; // Bỏ dòng này nếu không cần thiết
                    }
                    the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                }
            } elseif ( is_search() ) {
                ?>
                <div class="no-search-results-form section-inner thin">
                    <?php
                    get_search_form(
                        array(
                            'aria_label' => __( 'search again', 'twentytwenty' ),
                        )
                    );
                    ?>
                </div>
                <?php
            }
            // --- Hết code vòng lặp chính ---
            
            // Phân trang cho cột 2
            get_template_part( 'template-parts/pagination' ); 
            ?>
        </div>

       

    </div>
    <!-- ===== KẾT THÚC CONTAINER 3 CỘT ===== -->

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
