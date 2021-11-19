<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nexusolution
 */

?>


<footer>
    <!-- footer wedget -->
    <div class="container" id="footer">
        <div class="row">
            <div class="col-md-3 footer">
                <div class="footer-header">
                    <img class="footer-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png" alt="">
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, sequi maiores debitis officiis quas unde!</p>
                <div class="footer-socail-icon">
                    <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                    <a href="#"> <i class="fab fa-twitter"></i> </a>
                    <a href="#"> <i class="fab fa-youtube"></i> </a>
                </div>
            </div>
            <div class="col-md-3 footer">
                <div class="footer-header">
                    <h2>Pages </h2>
                </div>

                <ul>
                    <li><a href="#"> About </a></li>
                    <li><a href="#"> Services </a></li>

                </ul>
            </div>
            <div class="col-md-3 footer">
                <div class="footer-header">
                    <h2>Quick Link </h2>

                </div>

                <p></p>
            </div>
            <div class="col-md-3 footer footer_add">
                <div class="footer-header">
                    <h2>Get in touch </h2>
                </div>
                <div class="footer-content">
                    <ul>
                        <li> Tinpaini , Biratnagar , Nepal. </li>
                        <li> Phone : </li>
                        <li> Email : </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Copyright -->
    <div class="container" id="copyright">
        <div class="row">
            <div class="col-md-6">
                <p> &copy; 2021 Nexus All right reserved.</p>
            </div>
            <div class="col-md-6 powerby">
                <p>
                    Power by : <a href="#" target="_blank"> PDMT </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>