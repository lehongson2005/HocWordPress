<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
?>

<style>
/* Footer chính */
.custom-footer {
    background-color: #007b5e !important;
    color: white !important;
    text-align: center !important;
    padding: 30px 0 !important;
}

/* Container chứa text */
.custom-footer .footer-credits {
    display: block !important; /* đảm bảo block, không bị flex row */
    text-align: center !important;
}

/* Các <p> block riêng */
.custom-footer .footer-credits p {
    display: block !important;
    margin: 20px 130px !important;
    font-size: 14px !important;
}

/* Gạch dưới National Transaction Corporation */
.custom-footer .footer-credits u {
    text-decoration: underline !important;
}

/* Tùy chọn: hover màu cho Sunlimetech */
.custom-footer .footer-credits a {
    color: #ffffffff !important;
    text-decoration: none !important;
    transition: color 0.3s;
}
.custom-footer .footer-credits a:hover {
    color: #ffffff !important;
}
</style>

<footer id="site-footer" class="header-footer-group custom-footer">
    <div class="section-inner">

        <div class="footer-credits">
            <!-- Dòng 1 -->
            <p>
                <u>National Transaction Corporation</u> is a Registered MSP/ISO of Elavon, Inc. Georgia 
                [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]
            </p>

            <!-- Dòng 2 -->
            <p class="copyright">
                © All right Reserved. <a href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a>
            </p>
        </div><!-- .footer-credits -->

    </div><!-- .section-inner -->
</footer><!-- #site-footer -->

<?php wp_footer(); ?>
</body>
</html>
