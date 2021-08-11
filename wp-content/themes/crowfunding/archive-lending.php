<?php
/**
 * Template Name: Page (Lending)
 * Description: Page template full width.
 *
 */
?>
<?php get_header();
$siteurl = get_option('siteurl');
$item_id = get_the_ID();
$cat_id  = get_post_meta($item_id,'category',true);
$limit   = get_post_meta($item_id,'limit',true);
$cat_id  = ($cat_id) ? $cat_id : 0;
$limit   = ($limit) ? $limit : 10;
$custom_header_title  = get_post_meta($item_id,'custom_header_title',true);
$custom_header_title = ($custom_header_title) ? $custom_header_title : 'ソーシャルレンディング業者一覧';
$cr_page  = ( isset($_GET['mp']) ) ? $_GET['mp'] : 1;
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="<?= $siteurl; ?>" class="home"><span>TOP</span></a></span> ＞  
        <span><?= $custom_header_title; ?></span>  
    </div>
</div>
<div class="wrap__page" id="social_lending_app">   
    <div class="container">
        <header class="page__header">
            <h1 class="page__header__title"><?= $custom_header_title; ?></h1>
        </header><!-- .page-header -->

        <div class="archive__content pt-md-4 wow animate__animated animate__fadeInUp">
            <div  v-for="item in items" class="product__item -lenders ef--zoomin">
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
                        <ul class="el__tag" v-html="item.features_html"></ul>
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
                                        <span v-bind:style="{ width:item.average_rating }"></span>
                                    </div>
                                    <p>{{ item.average_value }} <span>({{ item.total_reviews }}件)</span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navigation paging-navigation" role="navigation">
            <div class="pagination loop-pagination">
                <a 
                    v-for="pageNumber in totalPages" 
                    v-on:click="loadPage(pageNumber,$event)"
                    v-bind:class="{ current : (pageNumber == page) }" 
                    class="page-numbers">{{ pageNumber }}
                </a>
            </div><!-- .pagination -->
        </nav>

    </div>
</div>
<script type="text/javascript">
   var mod_title  = '<?= $custom_header_title; ?>';   
    var limit      = '<?= $limit; ?>'; 
    var social_lending_app = new Vue({
      el: '#social_lending_app',
      data: {
        items: null,
        totalPages: null,
        page: '<?= $cr_page; ?>',
        mod_title: mod_title,
        setting: '?pagination=1&total_reviews=1&limit='+limit
      },
          methods : {
            loadPage(pageNumber,e){
                this.page = pageNumber;
                this.setUrl(pageNumber);

                axios
                .get('<?= $siteurl; ?>/wp-json/crowfunding/lendings'+this.setting+'&page='+pageNumber)
                .then( response => {
                    this.items = response.data.items;
                    this.totalPages = response.data.totalPages;
                })
            },
            setUrl(pageNumber){
                const url = new URL(window.location);
                url.searchParams.set('mp', pageNumber);
                window.history.pushState({}, '', url);
            }
       },
      mounted () {
	    axios
        .get('<?= $siteurl; ?>/wp-json/crowfunding/lendings'+this.setting+'&page='+this.page)
        .then( response => {
            this.items = response.data.items;
            this.totalPages = response.data.totalPages;
        })
	  }
    });
</script>
<?php get_footer();?>