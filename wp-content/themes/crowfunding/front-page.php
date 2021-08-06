<?php get_header(); ?>
    <section class="sc-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 animate__animated animate__backInLeft">
                    <header class="el__header">
                        <h2 class="el__header__title">クラファンなびを使って<br>ソーシャルレンディングを比較しよう</h2>
                        <p class="el__header__sub">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト</p>
                    </header>
                    <div class="el__img">
                        <img src="images/sc-header-img.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 animate__animated animate__backInRight">
                    <div class="box__advanced__search">
                        <div class="box__header">
                            <p class="box__header__title">- ソーシャルレンディングを検索 - </p>
                        </div>
                        <form action="" class="box__content">
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">事業者名</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">利回り</label>
                                <div class="col-sm-9">
                                <input type="text" class="js-range-slider" 
                                data-min="1"
                                data-max="15"
                                data-postfix="%" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">運用期間</label>
                                <div class="col-sm-9">
                                <input type="text" class="js-range-slider" 
                                data-min="1"
                                data-max="36"
                                data-postfix="ヶ月" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-4 col-sm-3 col-form-label">保証の有無</label>
                                <div class="col-8 col-sm-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">保証あり</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">保証なし</label>
                                      </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn__primary mb-sm-3">検索する</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php dynamic_sidebar( 'home_page' );?>

    

    

    <section class="sc-lending">
        <div class="container">
            <header class="sc__header text-center wow animate__animated animate__pulse">
                <h2 class="sc__header__title">投資に関するコラム</h2>
                <p class="sc__header__sub">COLUM</p>
            </header>
            <div class="sc__content wow animate__animated animate__fadeInUp">
                <div class="new__slider flickity" data-flickity='{ "autoPlay": true ,"cellAlign": "left", "contain": true, "wrapAround": true, "groupCells": true, "pageDots": false,"prevNextButtons": true }'">
                    <div class="col-12 col-md-6 col-lg-4 el__col">
                        <div class="new__item ef--zoomin">
                            <a href="" class="el__thumb dnfix__thumb -small">
                                <div class="el__status">コラム</div>
                                <img src="images/invest-1.png" alt="">
                            </a>
                            <div class="el__meta">
                                <div class="el__company">2020.01.23</div>
                                <h3 class="el__title"><a href="">不動産クラウドファンディングとREITの違いとは？</a></h3>

                                <ul class="el__tag">
                                    <li>1万円より</li>
                                    <li>償還時配当</li>
                                    <li>抽選式</li>
                                </ul>
                                <div class="el__sub">
                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 el__col">
                        <div class="new__item ef--zoomin">
                            <a href="" class="el__thumb dnfix__thumb -small">
                                <div class="el__status">コラム</div>
                                <img src="images/invest-2.png" alt="">
                            </a>
                            <div class="el__meta">
                                <div class="el__company">2020.01.23</div>
                                <h3 class="el__title"><a href="">不動産クラウドファンディングとREITの違いとは？</a></h3>

                                <ul class="el__tag">
                                    <li>1万円より</li>
                                    <li>償還時配当</li>
                                    <li>抽選式</li>
                                </ul>
                                <div class="el__sub">
                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 el__col">
                        <div class="new__item ef--zoomin">
                            <a href="" class="el__thumb dnfix__thumb -small">
                                <div class="el__status">コラム</div>
                                <img src="images/invest-1.png" alt="">
                            </a>
                            <div class="el__meta">
                                <div class="el__company">2020.01.23</div>
                                <h3 class="el__title"><a href="">不動産クラウドファンディングとREITの違いとは？</a></h3>

                                <ul class="el__tag">
                                    <li>1万円より</li>
                                    <li>償還時配当</li>
                                    <li>抽選式</li>
                                </ul>
                                <div class="el__sub">
                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="text-end">
                    <a href="" class="sc__readmore--text">記事一覧を見る<span class="icon-long-arrow-right"></span></a>
                </div>
              
            
            </div>
        </div>
    </section>

    <section class="sc-lending">
        <div class="container">
            <header class="sc__header text-center wow animate__animated animate__pulse">
                <h2 class="sc__header__title">ソーシャルレンディングニュース</h2>
                <p class="sc__header__sub">NEWS</p>
            </header>
            <div class="sc__content wow animate__animated animate__fadeInUp">
                <div class="new__slider flickity" data-flickity='{ "autoPlay": true ,"cellAlign": "left", "contain": true, "wrapAround": true, "groupCells": true, "pageDots": false,"prevNextButtons": true }'">
                    <div class="col-12 col-md-6 col-lg-4 el__col">
                        <div class="new__item ef--zoomin">
                            <a href="" class="el__thumb dnfix__thumb -small">
                                <div class="el__status">コラム</div>
                                <img src="images/invest-1.png" alt="">
                            </a>
                            <div class="el__meta">
                                <div class="el__company">2020.01.23</div>
                                <h3 class="el__title"><a href="">不動産クラウドファンディングとREITの違いとは？</a></h3>

                                <ul class="el__tag">
                                    <li>1万円より</li>
                                    <li>償還時配当</li>
                                    <li>抽選式</li>
                                </ul>
                                <div class="el__sub">
                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 el__col">
                        <div class="new__item ef--zoomin">
                            <a href="" class="el__thumb dnfix__thumb -small">
                                <div class="el__status">コラム</div>
                                <img src="images/invest-2.png" alt="">
                            </a>
                            <div class="el__meta">
                                <div class="el__company">2020.01.23</div>
                                <h3 class="el__title"><a href="">不動産クラウドファンディングとREITの違いとは？</a></h3>

                                <ul class="el__tag">
                                    <li>1万円より</li>
                                    <li>償還時配当</li>
                                    <li>抽選式</li>
                                </ul>
                                <div class="el__sub">
                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 el__col">
                        <div class="new__item ef--zoomin">
                            <a href="" class="el__thumb dnfix__thumb -small">
                                <div class="el__status">コラム</div>
                                <img src="images/invest-1.png" alt="">
                            </a>
                            <div class="el__meta">
                                <div class="el__company">2020.01.23</div>
                                <h3 class="el__title"><a href="">不動産クラウドファンディングとREITの違いとは？</a></h3>

                                <ul class="el__tag">
                                    <li>1万円より</li>
                                    <li>償還時配当</li>
                                    <li>抽選式</li>
                                </ul>
                                <div class="el__sub">
                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="text-end">
                    <a href="" class="sc__readmore--text">記事一覧を見る<span class="icon-long-arrow-right"></span></a>
                </div>
              
            </div>
        </div>
    </section>

    <section class="sc-customer">
        <div class="container">
            <header class="sc__header text-center wow animate__animated animate__pulse">
                <h2 class="sc__header__title">クチコミ</h2>
                <p class="sc__header__sub">Customer Voice</p>
            </header>
            <div class="sc__content wow animate__animated animate__fadeInUp">
                <div class="sc-customer__slider slider flickity" data-flickity='{ "autoPlay": false ,"cellAlign": "left", "contain": true, "wrapAround": true, "groupCells": true, "pageDots": false,"prevNextButtons": true }'>
               
                      <div class="col-12 col-md-6 el__wrap">
                        <div class="el__item">
                            <div class="el__thumb dnfix__thumb d-none d-sm-block">
                                <img src="images/sc-customer-1.png" alt="">
                            </div>
                            <div class="el__meta">
                                <div class="el__meta__mb">
                                    <div class="el__thumb dnfix__thumb d-sm-none">
                                        <img src="images/sc-customer-1.png" alt="">
                                    </div>
                                    <div class="d-sm-flex align-items-center">
                                        <h3 class="el__title">クラウドビルズ</h3>
                                        <div class="item__rating ms-sm-3">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span style="width:80%;">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="el__date">20代 女性│2020.02.15</div>
                                <div class="el__comment text__truncate -n3">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト…</div>
                                <div class="text-end">> 詳しくはこちら</div>
                            </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6 el__wrap">
                        <div class="el__item">
                            <div class="el__thumb dnfix__thumb">
                                <img src="images/sc-customer-2.png" alt="">
                            </div>
                            <div class="el__meta">
                                <div class="el__meta__mb">
                                    <div class="el__thumb dnfix__thumb d-sm-none">
                                        <img src="images/sc-customer-2.png" alt="">
                                    </div>
                                    <div class="d-sm-flex align-items-center">
                                        <h3 class="el__title">クラウドビルズ</h3>
                                        <div class="item__rating ms-sm-3">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span style="width:80%;">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="el__date">20代 女性│2020.02.15</div>
                                <div class="el__comment text__truncate -n3">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト…</div>
                                <div class="text-end">> 詳しくはこちら</div>
                            </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6 el__wrap">
                        <div class="el__item">
                            <div class="el__thumb dnfix__thumb">
                                <img src="images/sc-customer-2.png" alt="">
                            </div>
                            <div class="el__meta">
                                <div class="el__meta__mb">
                                    <div class="el__thumb dnfix__thumb d-sm-none">
                                        <img src="images/sc-customer-1.png" alt="">
                                    </div>
                                    <div class="d-sm-flex align-items-center">
                                        <h3 class="el__title">クラウドビルズ</h3>
                                        <div class="item__rating ms-sm-3">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span style="width:80%;">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="el__date">20代 女性│2020.02.15</div>
                                <div class="el__comment text__truncate -n3">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト…</div>
                                <div class="text-end">> 詳しくはこちら</div>
                            </div>
                        </div>
                      </div>
                 
                </div>
            </div>
            <div class="text-end">
                <a href="" class="sc__readmore--text">クチコミ一覧を見る<span class="icon-long-arrow-right"></span></a>
            </div>
        </div>
    </section>

    <section class="sc-tag">
        <div class="container">
            <header class="sc-tag__header text-center">
                <h2 class="sc-tag__header__title">＃人気のタグ</h2>
            </header>
            <ul class="sc-tag__list wow animate__animated animate__fadeInUp">
                <li><a href="">不動産投資</a></li>
                <li><a href="">ソーシャルレンディング</a></li>
                <li><a href="">クラウドファンディング</a></li>
                <li><a href="">利回り</a></li>
                <li><a href="">S T O</a></li>
                <li><a href="">マネタイズ</a></li>
                <li><a href="">投資利回り</a></li>
                <li><a href="">クラウドファンディング</a></li>
                <li><a href="">利回り</a></li>
                <li><a href="">S T O</a></li>
                <li><a href="">マネタイズ</a></li>
            </ul>
            <div class="text-end">
                <a href="" class="sc__readmore--text">全てのタグを見る<span class="icon-long-arrow-right"></span></a>
            </div>
        </div>
    </section>

    <section class="sc-3box">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex wow animate__animated animate__fadeInLeft">
                    <div class="el__item"></div>
                </div>
                <div class="col-md-4 d-flex wow animate__animated animate__fadeInUp">
                    <div class="el__item"></div>
                </div>
                <div class="col-md-4 wow animate__animated animate__fadeInRight">
                    <div class="el__item -text">
                        <h3 class="el__title">クラファンなび</h3>
                        <div class="d-flex">
                            <div class="el__excerpt flex-grow-1">
                                取材のご依頼や、<br>広告掲載に関する<br>お問い合わせはこちら
                            </div>
                            <div class="el__icon">
                                <span class="icon-long-arrow-right"></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        var recommended_social_lending_app = new Vue({
              el: '#recommended-social-lending',
              data: {
                products: [
                    {
                        title : 'CROWD BUILDS（クラウドビルズ)'
                    },
                    {
                        title : 'CROWD BUILDS（クラウドビルズ)'
                    },
                    {
                        title : 'CROWD BUILDS（クラウドビルズ)'
                    }
                ],
                mod_title: 'オススメソーシャルレンディング事業者'
              }
            });
    </script>
    

<?php get_footer(); ?>
        