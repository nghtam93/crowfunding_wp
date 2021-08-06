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
    <div class="modal modal-search fade" id="modalSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-close">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form role="search" method="get" class="search-form" action="">
                    <input type="search" class="search-field form-control" placeholder="Search ..." name="s" />
                    <button class="search-submit" type="submit"><span class="icon-search"></span></button>
                </form>
            </div>
        </div>
        </div>
    </div>
    
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