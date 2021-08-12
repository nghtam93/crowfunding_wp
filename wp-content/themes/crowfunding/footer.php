
        <?php dynamic_sidebar( 'third_widget_area' );?>
    
        <footer class="sc-footer">
            <div class="container">
                <ul class="box-social">
                    <li><a href=""><span class="icon-twitter"></span></a></li>
                    <li><a href=""><span class="icon-facebook"></span></a></li>
                    <li><a href=""><span class="icon-instagram"></span></a></li>
                </ul>
                <hr>

                <nav class="footer__nav">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu',
                            'container'      => '',
                            'menu_class'     => '',
                            'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'         => new WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </nav>

                <div class="sc-copyright">
                    <p>©︎ Crowfunding Inc. All right reserved</p>
                </div>
            </div>
        </footer>

    </div> <!-- end wrapper -->

    <!-- Modal -->
    <?php get_template_part('template-parts/search-form');?>
    
    <nav id="menu__mobile" class="nav__mobile">
        <div class="nav__mobile__content">
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'mobile-menu',
                        'container'      => '',
                        'menu_class'     => 'nav__mobile--ul',
                        'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'         => new WP_Bootstrap_Navwalker(),
                    )
                );
            ?>
        </div>
    </nav>
    <?php wp_footer(); ?>

    <script>
        (function($){

            $(".js-range-slider").ionRangeSlider({
                skin: "round",
                type: "double",
            });

        })(jQuery);

        
    </script>

</body>
</html>