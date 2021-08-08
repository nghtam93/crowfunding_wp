<?php
/**
 * Template Name: Page (Blog)
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
<div class="wrap__page" id="social_news_app">   
    <div class="container">
        <header class="page__header">
            <h1 class="page__header__title"><?= $custom_header_title; ?></h1>
        </header><!-- .page-header -->

        <div  class="archive__content pt-md-4 wow animate__animated animate__fadeInUp">
            <div v-if="items" class="row">
                <div v-for="item in items" class="col-12 col-md-6 col-lg-4 el__col">
                    <div class="new__item ef--zoomin">
                        <a v-bind:href="item.post_link" class="el__thumb dnfix__thumb -small">
                            <div class="el__status">{{ item.cat_name }}</div>
                            <img v-bind:src="item.post_image" alt="">
                        </a>
                        <div class="el__meta">
                            <div class="el__company">{{ item.post_date }}</div>
                            <h3 class="el__title"><a v-bind:href="item.post_link" class="text__truncate -n2">{{ item.post_title }}</a></h3>

                            <ul class="el__tag" v-html="item.tags_html"></ul>
                            <div class="el__sub">
                                {{ item.post_excerpt }}…
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        <nav v-if="items" class="navigation paging-navigation" role="navigation">
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
 var cat_id 	= '<?= $cat_id; ?>';	
 var mod_title 	= '<?= $custom_header_title; ?>';	
 var limit 		= '<?= $limit; ?>';	
 var social_news_app = new Vue({
   el: '#social_news_app',
   data: {
     items: null,
     totalPages: null,
     page: '<?= $cr_page; ?>',
     mod_title: mod_title,
     setting: '?pagination=1&limit='+limit+'&cat_id='+cat_id
   },
   methods : {
   		loadPage(pageNumber,e){
   			this.page = pageNumber;
   			this.setUrl(pageNumber);

   			axios
		    .get('<?= $siteurl; ?>/wp-json/crowfunding/news'+this.setting+'&page='+pageNumber)
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
	    .get('<?= $siteurl; ?>/wp-json/crowfunding/news'+this.setting+'&page='+this.page)
	    .then( response => {
	    	this.items = response.data.items;
	    	this.totalPages = response.data.totalPages;
    	})
	}
 });
</script>
<?php get_footer();?>