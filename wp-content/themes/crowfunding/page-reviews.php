<?php
/**
 * Template Name: Page (Reviews)
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
$custom_header_title = ($custom_header_title) ? $custom_header_title : get_the_title();
$cr_page  = ( isset($_GET['mp']) ) ? $_GET['mp'] : 1;
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="<?= $siteurl; ?>" class="home"><span>TOP</span></a></span> ＞  
        <span><?= $custom_header_title; ?></span>
    </div>
</div>
<div class="wrap__page" id="social_reviews_app">   
    <div class="container">
        <header class="page__header">
            <h1 class="page__header__title"><?= $custom_header_title; ?></h1>
        </header><!-- .page-header -->

        <div v-if="items" class="sc-review-list">
            <div v-for="item in items" class="el__item">
                <div class="el__thumb dnfix__thumb -contain d-none d-sm-block">
                    <img v-bind:src="item.review_image" alt="">
                </div>
                <div class="el__meta">
                    <div class="el__meta__mb">
                        <div class="el__thumb dnfix__thumb -contain d-flex d-sm-none">
                            <img v-bind:src="item.review_image" alt="">
                        </div>
                        <div class="d-block d-sm-none">
                            <h3 class="el__title">クラウドビルズ</h3>
                            <div class="el__sub mb-0">20代 / 男性 / ファンド名</div>
                        </div>

                        <div class="d-block d-sm-flex align-items-center ms-auto">
                            <h3 class="el__title d-none d-sm-block">クラウドビルズ</h3>
                            <div class="item__rating ">
                                <div class="star-rating -small" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:100%;">
                                    </span>
                                </div>
                                <span class="count d-none d-sm-block">5</span>
                            </div>
                            <div class="el__date ms-auto">{{ item.comment_date }}</div>
                        </div>
                        <div class="el__sub d-none d-sm-block">20代 / 男性 / ファンド名（株式会社フィンスター）</div>
                    </div>
                    <div class="el__comment text__truncate -n3">
                        {{ item.comment_content }}
                    </div>
                </div>
            </div>
        </div>

        <nav v-if="items" class="navigation paging-navigation mb-5" role="navigation">
            <div class="pagination loop-pagination">
                <a 
                    v-for="pageNumber in totalPages" 
                    v-on:click="loadPage(pageNumber,$event)"
                    v-bind:class="{ current : (pageNumber == page) }" 
                    class="page-numbers">{{ pageNumber }}
                </a>
            </div><!-- .pagination -->
        </nav>

        <div class="sc-review-list__readmore text-center">
            <a href="<?= get_the_permalink(119);?>" class="btn btn__primary mb-sm-3">口コミレビューを投稿する</a>
        </div>
    </div>
</div>
<script type="text/javascript">  
 var mod_title  = '<?= $custom_header_title; ?>';   
 var limit      = '<?= $limit; ?>'; 
 var social_news_app = new Vue({
   el: '#social_reviews_app',
   data: {
     items: null,
     totalPages: null,
     page: '<?= $cr_page; ?>',
     mod_title: mod_title,
     setting: '?pagination=1&limit='+limit
   },
   methods : {
        loadPage(pageNumber,e){
            this.page = pageNumber;
            this.setUrl(pageNumber);

            axios
            .get('<?= $siteurl; ?>/wp-json/crowfunding/reviews'+this.setting+'&page='+pageNumber)
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
        .get('<?= $siteurl; ?>/wp-json/crowfunding/reviews'+this.setting+'&page='+this.page)
        .then( response => {
            this.items = response.data.items;
            this.totalPages = response.data.totalPages;
        })
    }
 });
</script>
<?php get_footer(); ?>