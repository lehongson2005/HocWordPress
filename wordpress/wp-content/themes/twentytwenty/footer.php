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
/* 🌿 Footer chính */
.custom-footer {
    background-color: #007b5e !important;
    color: #ffffff !important;
    text-align: center !important;
    padding: 30px 20px !important;
    font-family: 'Arial', sans-serif;
}

/* Container chứa nội dung */
.custom-footer .footer-credits {
    max-width: 900px;
    margin: 0 auto;
    text-align: center !important; /* ✅ đảm bảo toàn bộ text canh giữa */
}

/* Các đoạn văn */
.custom-footer .footer-credits p {
    margin: 15px auto !important;
    font-size: 15px !important;
    line-height: 1.6 !important;
    text-align: center !important; /* ✅ canh giữa từng dòng */
}

/* Riêng phần bản quyền */
.custom-footer .footer-credits .copyright {
    text-align: center !important; /* ✅ fix canh giữa */
    display: block !important;
    width: 100% !important;
    font-weight: bold;
}

/* Gạch dưới National Transaction Corporation */
.custom-footer .footer-credits u {
    text-decoration: underline !important;
}

/* Liên kết */
.custom-footer .footer-credits a {
    color: #ffffff !important;
    text-decoration: none !important;
    transition: opacity 0.3s ease;
}

.custom-footer .footer-credits a:hover {
    opacity: 0.8;
}

/* 🌍 Responsive */
@media (max-width: 768px) {
    .custom-footer {
        padding: 20px 15px !important;
    }

    .custom-footer .footer-credits p {
        font-size: 14px !important;
        margin: 10px 0 !important;
    }
}

@media (max-width: 480px) {
    .custom-footer {
        padding: 15px 10px !important;
    }

    .custom-footer .footer-credits p {
        font-size: 13px !important;
        line-height: 1.5 !important;
    }
}
/* 🌍 Responsive cho social icons */
.wp-block-social-links {
    display: flex;
    justify-content: center; /* Căn giữa các icon */
    align-items: center;
    gap: 10px; /* Khoảng cách giữa các icon */
    flex-wrap: wrap; /* ✅ Cho phép xuống dòng khi màn hình nhỏ */
    padding: 10px 0;
}

/* Mỗi icon */
.wp-block-social-link {
    list-style: none;
}

/* Kích thước và màu */
.wp-block-social-link a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    background-color: #ffffff20; /* nền mờ nhẹ */
    border-radius: 50%;
    transition: all 0.3s ease;
}

/* Hover hiệu ứng */
.wp-block-social-link a:hover {
    background-color: #ffffff40;
    transform: scale(1.1);
}

/* Icon SVG căn giữa */
.wp-block-social-link svg {
    width: 20px;
    height: 20px;
    fill: #fff; /* màu trắng */
}

/* 📱 Màn hình điện thoại */
@media (max-width: 480px) {
    .wp-block-social-links {
        gap: 8px;
        flex-wrap: wrap;
    }

    .wp-block-social-link a {
        width: 35px;
        height: 35px;
    }

    .wp-block-social-link svg {
        width: 18px;
        height: 18px;
    }
}
</style>


<footer id="site-footer" class="header-footer-group custom-footer">
    <div class="section-inner">

        <div class="footer-credits">
            <!-- Dòng 1 -->
            <p>
                <u>National Transaction Corporion</u> is a Registed MSP/ISO of Elavon, Inc. Georgia 
                [a wholly owned subsidiary of U.S. Bancorp,Minneapolis,MN]
            </p>

            <!-- Dòng 2 -->
            <p class="copyright">
                © All rights reserved. 
                <a href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a>
            </p>
        </div><!-- .footer-credits -->

    </div><!-- .section-inner -->
</footer><!-- #site-footer -->

<?php wp_footer(); ?>
</body>
</html>
