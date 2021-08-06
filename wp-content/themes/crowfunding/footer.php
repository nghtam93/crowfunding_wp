<footer class="sc-footer">
            <div class="container">
                <ul class="box-social">
                    <li><a href=""><span class="icon-twitter"></span></a></li>
                    <li><a href=""><span class="icon-facebook"></span></a></li>
                    <li><a href=""><span class="icon-instagram"></span></a></li>
                </ul>
                <hr>

                <nav class="footer__nav">
                    <ul class="">
                        <li class="menu-item"><a href="">クラファンなびについて</a></li>
                        <li class="menu-item"><a href="">お問い合わせ</a></li>
                        <li class="menu-item"><a href="">プライバシーポリシー</a></li>
                        <li class="menu-item"><a href="">利用規約</a></li>
                        <li class="menu-item"><a href="">運営会社</a></li>
                    </ul>
                </nav>

                <div class="sc-copyright">
                    <p>©︎ finstar Inc. All right reserved</p>
                </div>
            </div>
        </footer>

    </div> <!-- end wrapper -->

    <!-- Modal -->
    <?php get_template_part('template-parts/search-form');
    
    <nav id="menu__mobile" class="nav__mobile">
        <div class="nav__mobile__content">
            <ul class="nav__mobile--ul">
                <li class="menu-item menu-item-has-children"><a href="">クラファンなび</a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="">ファンドの詳細</a></li>
                    </ul>
                </li>
                <li class="menu-item"><a href="">ファンド検索/一覧</a></li>
                <li class="menu-item menu-item-has-children"><a href="">ソーシャルレンディング</a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="">ソーシャルレンディング企業の詳細</a></li>
                        <li class="menu-item"><a href="">口コミレビュー一覧</a></li>
                    </ul>
                </li>
                <li class="menu-item"><a href="">投資に関するコラム</a></li>
                <li class="menu-item"><a href="">ソーシャルレンディングニュース</a></li>
                <li class="menu-item"><a href="">用語集</a></li>
                <li class="menu-item"><a href="">運営者</a></li>
                <li class="menu-item"><a href="">プライバシーポリシー</a></li>
                <li class="menu-item"><a href="">お問い合わせ</a></li>
            </ul>
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