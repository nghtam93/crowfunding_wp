<?php
/**
 * Template Name: Page (Fund)
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
$business_name  = ( isset($_GET['business_name']) ) ? $_GET['business_name'] : '';
$yield          = ( isset($_GET['yield']) ) ? $_GET['yield'] : '1;15';
$period         = ( isset($_GET['period']) ) ? $_GET['period'] : '1;36';
$guarantees     = ( isset($_GET['guarantee']) ) ? $_GET['guarantee'] : [];
$yields         = explode(';',$yield);

$have_guarante = $have_no_guarante = 0;
foreach ($guarantees as $key => $value) {
    if( $value == 0 ){
        $have_guarante = 1;
    }
    if( $value == 1 ){
        $have_no_guarante = 1;
    }
}
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
                            <select name="business_name" class="form-control">
                                <option value=""> </option>
                                <option v-for="company in companies" v-bind:value="company"
                                v-bind:selected="company == cr_company"
                                >{{ company }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">利回り</label>
                        <div class="col-sm-9">
                        <input type="text" class="js-range-slider" 
                        name="yield" 
                        value="<?= $yield; ?>" 
                        data-min="1"
                        data-max="15"
                        data-postfix="%" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">運用期間</label>
                        <div class="col-sm-9">
                        <input type="text" class="js-range-slider" 
                        name="period"
                        value="<?= $period; ?>" 
                        data-min="1"
                        data-max="36"
                        data-postfix="ヶ月" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-4 col-sm-3 col-form-label">保証の有無</label>
                        <div class="col-8 col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="g_ja" value="0"
                                name="guarantee[]"
                                <?= ($have_guarante) ? 'checked' : '';?>
                                >
                                <label class="form-check-label" for="g_ja">保証あり</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="g_nee" value="1" name="guarantee[]"
                                <?= ($have_no_guarante) ? 'checked' : '';?>
                                >
                                <label class="form-check-label" for="g_nee">保証なし</label>
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
            <div v-for="item in items" class="product__item ef--zoomin">
                <div class="row">
                    <div class="col-md-5 col-lg-34 wow animate__animated animate__fadeInLeft">
                        <a v-bind:href="item.post_link" class="el__thumb dnfix__thumb">
                            <div class="el__status">募集中</div>
                            <img v-bind:src="item.post_image" alt="">
                        </a>
                    </div>
                    <div class="col-md-7 col-lg-66 wow animate__animated animate__fadeInRight">
                        <h3 class="el__title"><a v-bind:href="item.post_link" class="text__truncate -n2">{{ item.post_title }}</a></h3>
                        <div class="d-flex">
                            <span class="me-3">クラウドビルズ</span>
                            <span>({{ item.comment_count }}件のクチコミ）</span>
                        </div>
                        <ul class="el__tag" v-html="item.features_html"></ul>
                        <div class="el__sub text__truncate">
                            {{ item.post_excerpt }}…
                        </div>
                        <ul class="el__list">
                            <li>
                                <label>募集総額</label>
                                <p>{{ item.fund_values_total_offer }}<span>万円</span></p>
                            </li>
                            <li>
                                <label>予定分配率</label>
                                <p>{{ item.fund_values_planned_distribution_rate }}<span>%</span></p>
                            </li>
                            <li>
                                <label>運用期間</label>
                                <p>{{ item.fund_values_operation_period }}<span>ヶ月</span></p>
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
    var have_guarante       = '<?= $have_guarante; ?>'; 
    var have_no_guarante    = '<?= $have_no_guarante; ?>'; 
    var social_fund_app = new Vue({
   el: '#social_fund_app',
   data: {
        companies: null,
        cr_company: '<?= $business_name; ?>',
        items: null,
        totalPages: null,
        page: '<?= $cr_page; ?>',
        mod_title: mod_title,
        setting: '?pagination=1&limit='+limit+'&have_guarante='+have_guarante+'&have_no_guarante='+have_no_guarante
      },
      methods : {
        loadPage(pageNumber,e){
            this.page = pageNumber;
            this.setUrl(pageNumber);

            axios
            .get('<?= $siteurl; ?>/wp-json/crowfunding/funds'+this.setting+'&page='+pageNumber)
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
    .get('<?= $siteurl; ?>/wp-json/crowfunding/funds'+this.setting+'&page='+this.page)
    .then( response => {
        this.items = response.data.items;
        this.totalPages = response.data.totalPages;
    });

    axios
    .get('<?= $siteurl; ?>/wp-json/crowfunding/forms/get_business')
    .then( response => {
        this.companies = response.data.items;
    });


  }
 });
</script>
<?php get_footer();?>