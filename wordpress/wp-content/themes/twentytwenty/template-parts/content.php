<?php
// ===========================
// Template hiển thị bài viết (danh sách & trang đơn)
// ===========================

// Nếu KHÔNG phải bài viết đơn (ví dụ: trang chủ, danh mục, tìm kiếm...)
if ( ! is_singular() ) :
?>
    <article <?php post_class('custom-post-item'); ?> id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="full-link-wrap">

            <div class="custom-post-wrap">

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="custom-post-thumbnail">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>

                <div class="custom-post-date">
                    <div class="day-large">
                        <?php the_time('d'); ?>
                    </div>
                    <div class="month-small">
                        <?php echo 'THÁNG ' . get_the_time('m'); ?>
                    </div>
                </div>

                <div class="custom-post-divider"></div>

                <div class="custom-post-content">
                    <h2 class="entry-title"><?php the_title(); ?></h2>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>

            </div> <!-- .custom-post-wrap -->

        </a>
    </article>

<?php
// ===========================
// Nếu LÀ bài viết đơn (trang chi tiết) -> THAY THẾ BẰNG BỐ CỤC 3 CỘT
// ===========================
else :
?>

    <!-- BẮT ĐẦU CONTAINER FLEXBOX 3 CỘT -->
    <div class="single-post-three-column-layout">

        <!-- ===== CỘT 1: THỂ LOẠI (sidebar-left) ===== -->
        <aside class="sidebar-left" aria-label="Thể loại bài viết">
            <div class="widget widget_categories">
                <h2 class="widget-title"><?php _e( 'Categories', 'twentytwenty' ); ?></h2>
                <?php
                // Kiểm tra xem sidebar 'left-sidebar' có được đăng ký và có widget không
                if ( is_active_sidebar( 'left-sidebar' ) ) {
                    dynamic_sidebar( 'left-sidebar' );
                } else {
                    // Hiển thị widget Categories mặc định nếu sidebar trống
                    // Bạn có thể tùy chỉnh thêm các tham số tại đây
                    echo '<ul>';
                    wp_list_categories( array(
                        'title_li' => '', // Ẩn tiêu đề mặc định của widget
                        'style'    => 'list',
                        'orderby'  => 'name',
                        'show_count' => false,
                    ) );
                    echo '</ul>';
                }
                ?>
            </div>
        </aside>

        <!-- ===== CỘT 2: CHI TIẾT BÀI VIẾT (post-detail-center) ===== -->
        <main class="post-detail-center" role="main">
            
            <!-- Code gốc của bạn cho cột 2 được đặt vào đây -->
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?>">
                    <header class="entry-header-with-date">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <!-- Khối ngày tháng năm của bạn (bạn nói đã CSS đẹp) -->
                        <div class="post-date-right">
                            <div class="day"><?php echo get_the_time('d'); ?></div>
                            <div class="month"><?php echo get_the_time('m'); ?></div>
                            <div class="year"><?php echo get_the_time('y'); ?></div>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_content(__('Continue reading', 'twentytwenty')); ?>
                    </div>
                </div>

                <div class="section-inner">
                    <?php
                    wp_link_pages(array(
                        'before' => '<nav class="page-links">',
                        'after'  => '</nav>',
                    ));

                    edit_post_link();

                    twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');

                    if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {
                        get_template_part('template-parts/entry-author-bio');
                    }
                    ?>
                </div>
                
                <?php
                // LƯU Ý: Điều hướng và Bình luận sẽ được đặt BÊN DƯỚI khối 3 cột
                ?>
            </article>
            <!-- Kết thúc code gốc cột 2 -->

        </main>

        

    </div>
    <!-- KẾT THÚC CONTAINER FLEXBOX 3 CỘT -->


    <!-- ===== PHẦN ĐIỀU HƯỚNG VÀ BÌNH LUẬN (Được giữ lại) ===== -->
    <?php
    // Đây là phần chuyển trang (Next/Prev) mà bạn muốn giữ lại
    if (is_single()) {
        get_template_part('template-parts/navigation');
    }

    // Đây là phần bình luận mà bạn muốn giữ lại
    if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
        ?>
        <div class="comments-wrapper section-inner">
            <?php comments_template(); ?>
        </div>
        <?php
    }
    ?>
    <!-- ===== KẾT THÚC PHẦN GIỮ LẠI ===== -->

<?php endif; // Kết thúc câu lệnh if ( ! is_singular() ) ?>
