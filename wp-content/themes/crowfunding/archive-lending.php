<?php
/**
 * Template Name: Page (Lending)
 * Description: Page template full width.
 *
 */
?>
<?php get_header();
$siteurl = get_option('siteurl');
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="<?= $siteurl; ?>" class="home"><span>TOP</span></a></span> ＞  
        <span>ソーシャルレンディング業者一覧</span>  
    </div>
</div>
<div class="wrap__page" id="social_lending_app">   
    <div class="container">
        <header class="page__header">
            <h1 class="page__header__title">ソーシャルレンディング業者一覧</h1>
        </header><!-- .page-header -->

        <div class="archive__content pt-md-4 wow animate__animated animate__fadeInUp">
            <div  v-for="item in products" class="product__item -lenders ef--zoomin">
                <div class="row">
                    <div class="col-md-5 col-lg-34 wow animate__animated animate__fadeInLeft">
                        <a v-bind:href="item.post_link" class="el__thumb dnfix__thumb">
                            <img v-bind:src="item.post_image" alt="">
                        </a>
                    </div>
                    <div class="col-md-7 col-lg-66 wow animate__animated animate__fadeInRight">
                        <h3 class="el__title text-truncate"><a v-bind:href="item.post_link">{{ item.post_title }}</a></h3>
                        <div>
                            <span>株式会社フィンスター</span>
                        </div>
                        <ul class="el__tag">
                            <li>不動産</li>
                            <li>太陽光発電</li>
                            <li>抽選式</li>
                            <li>STO</li>
                        </ul>
                        <div class="el__sub text__truncate">
                            {{ item.post_excerpt }}…
                        </div>
                        <ul class="el__list">
                            <li>
                                <label>平均利回り</label>
                                <p>5.5<span>%〜</span>8.5<span>%</span></p>
                            </li>
                            <li>
                                <label>平均募集金額</label>
                                <p>2500<span>万円</span></p>
                            </li>
                            <li>
                                <label class="-text-fix">クチコミ・レビュー</label>
                                <div class="d-lg-flex align-items-center">
                                    <div class="star-rating -small" role="img" aria-label="Rated 4.00 out of 5">
                                        <span style="width:100%;">
                                        </span>
                                    </div>
                                    <p>4.7 <span>(48件)</span></p>
                                </div>
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
    var social_lending_app = new Vue({
      el: '#social_lending_app',
      data: {
        products: null,
      },
      mounted () {
	    axios
	      .get('<?= $siteurl; ?>/wp-json/crowfunding/lendings')
	      .then( response => (this.products = response.data) )
	  }
    });
</script>
<?php get_footer();?>