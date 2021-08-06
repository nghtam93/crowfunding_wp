<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

  </head>
  <body <?php body_class(); ?>>
    <div class="wrapper">

        <header class="header header--sticky" data-toggle="sticky-onscroll">
            <div class="container-fluid d-flex align-items-center">
                <a href="#menu__mobile" class="menu-mb__btn">
                    <span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></span>
                </a>
                <div class="header__brand">
                    <a href="<?= home_url(); ?>" class="header--logo">
                        <img src="images/logo.png" alt="">
                    </a>
                </div>
                <nav class="main__nav ms-auto">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main-menu',
                            'container'      => '',
                            'menu_class'     => 'dn__menu d-none d-lg-block',
                            'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'         => new WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </nav>
                <button class="header__search--btn btn" type="submit" data-bs-toggle="modal" data-bs-target="#modalSearch"><span class="icon-search"></span></button>
            </div>
        </header>

        <nav class="main__nav d-md-none">
            <ul class="dn__menu">
                <li class="menu-item "><a href="#">ファンド検索</a></li>
                <li class="menu-item "><a href="#">ソーシャルレンディング業者一覧</a></li>
                <li class="menu-item "><a href="#">クチコミ・レビュー</a></li>
                <li class="menu-item "><a href="#">投資に関するコラム</a></li>
                <li class="menu-item "><a href="#">ニュース</a></li>
            </ul>
        </nav>