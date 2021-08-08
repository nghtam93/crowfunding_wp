<?php
/**
 * Template Name: Page (Fund)
 * Description: Page template full width.
 *
 */
?>
<?php get_header();
$siteurl = get_option('siteurl');
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="#" class="home"><span>TOP</span></a></span> ＞  
        <span>ファンド検索/一覧</span>  
    </div>
</div>
<div class="wrap__page" id="social_fund_app">   
    <div class="container">
        <header class="page__header">
            <h1 class="page__header__title">ファンド検索/一覧</h1>
        </header><!-- .page-header -->

        <section class="sc-search">
            <div class="box__advanced__search mx-auto">
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
        </section>

        <div class="archive__content wow animate__animated animate__fadeInUp">
            <div v-for="product in products" class="product__item ef--zoomin">
                <div class="row">
                    <div class="col-md-5 col-lg-34 wow animate__animated animate__fadeInLeft">
                        <a v-bind:href="product.post_link" class="el__thumb dnfix__thumb">
                            <div class="el__status">募集中</div>
                            <img v-bind:src="product.post_image" alt="">
                        </a>
                    </div>
                    <div class="col-md-7 col-lg-66 wow animate__animated animate__fadeInRight">
                        <h3 class="el__title"><a v-bind:href="product.post_link" class="text__truncate -n2">{{ product.post_title }}</a></h3>
                        <div class="d-flex">
                            <span class="me-3">クラウドビルズ</span>
                            <span>({{ product.comment_count }}件のクチコミ）</span>
                        </div>
                        <ul class="el__tag" v-html="product.features_html"></ul>
                        <div class="el__sub text__truncate">
                            {{ product.post_excerpt }}…
                        </div>
                        <ul class="el__list">
                            <li>
                                <label>募集総額</label>
                                <p>{{ product.fund_values_total_offer }}<span>万円</span></p>
                            </li>
                            <li>
                                <label>予定分配率</label>
                                <p>{{ product.fund_values_planned_distribution_rate }}<span>%</span></p>
                            </li>
                            <li>
                                <label>運用期間</label>
                                <p>{{ product.fund_values_operation_period }}<span>ヶ月</span></p>
                            </li>
                            <li>
                                <label>保証</label>
                                <p>有り</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navigation paging-navigation" role="navigation">
            <div class="pagination loop-pagination">
                <span aria-current="page" class="page-numbers current">1</span>
                <a class="page-numbers" href="#">2</a>
                <a class="page-numbers" href="#">3</a>
                <a class="page-numbers" href="#">4</a>
                <a class="page-numbers" href="#">...</a>
                <a class="page-numbers" href="#">15</a>
            </div><!-- .pagination -->
        </nav>

    </div>
</div>
<script type="text/javascript">
 var social_fund_app = new Vue({
   el: '#social_fund_app',
   data: {
     products: null,
   },
   mounted () {
  axios
    .get('<?= $siteurl; ?>/wp-json/crowfunding/funds?pagination=1')
    .then( response => (this.products = response.data) )
}
 });
</script>
<?php get_footer();?>