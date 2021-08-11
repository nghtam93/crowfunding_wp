<?php get_header();
$siteurl = get_option('siteurl');
$post_id = get_the_ID();
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="#" class="home"><span>TOP</span></a></span> ＞  
        <span><a href="#" class="home"><span> ソーシャルレンディング事業者一覧</span></a></span> ＞  
        <span>~~~</span>  
    </div>
</div>
<div class="wrap__content" id="lending_detail_app">   
    <div v-if="item" class="wrap__page">   
        <div class="container">
            <header class="page__header">
                <h1 class="page__header__title">{{ item.post_title }}の詳細</h1>
            </header><!-- .page-header -->

            <div class="table-of-contents">
                <div class="el__header">
                    <h3 class="el__header__title">目次 <span class="el__header__sub">[非表示]</span></h3>
                </div>
                <ul class="el__list">
                    <li v-for="table_of_content in item.table_of_contents">
                        <a href="">{{ table_of_content.title }}</a>
                        <ul class="-sub">
                            <li v-for="content in table_of_content.content">
                                <a href="">{{ content.title_of_content }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="single-lenders__content">

                <div class="single-lenders__img">
                    <img src="images/lenders-details/lenders-details-img.png" alt="">
                </div>

                <header class="page__header">
                    <h2 class="page__header__title">募集概要</h2>
                </header><!-- .page-header -->
                <div class="entry-content">
                    <table class="single-lenders__table table table-bordered">
                        <tbody>
                            <tr>
                                <td>運営</td>
                                <td>{{ item.recruitment_outline_operation_type }}</td>
                            </tr>
                            <tr>
                                <td>設立</td>
                                <td>{{ item.recruitment_outline_set_up }}</td>
                            </tr>
                            <tr>
                                <td>住所</td>
                                <td>{{ item.recruitment_outline_address }}</td>
                            </tr>
                            <tr>
                                <td>株主</td>
                                <td>{{ item.recruitment_outline_shareholders }}</td>
                            </tr>
                            <tr>
                                <td>役員</td>
                                <td>{{ item.recruitment_outline_board_member }}</td>
                            </tr>
                            <tr>
                                <td>利回り</td>
                                <td>{{ item.recruitment_outline_yield }}</td>
                            </tr>
                            <tr>
                                <td>口座種類</td>
                                <td>{{ item.recruitment_outline_account_type }}</td>
                            </tr>
                            <tr>
                                <td>入金銀行</td>
                                <td>{{ item.recruitment_outline_deposit_bank }}</td>
                            </tr>
                            <tr>
                                <td>貸し倒れ</td>
                                <td>{{ item.recruitment_outline_bad_debt }}</td>
                            </tr>
                            <tr>
                                <td>行政処分</td>
                                <td>{{ item.recruitment_outline_administrative_disposition }}</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <header class="page__header">
                    <h2 class="page__header__title">{{ item.post_title }}の特徴</h2>
                </header><!-- .page-header -->
                <div class="single-lenders__img">
                    <img src="images/lenders-details/lenders-details-img.png" alt="">
                </div>

                <div class="el__block">
                    <div v-for="feature in item.features" class="mb-5">
                        <h3 class="el__title">{{ feature.feature_title }}</h3>
                        <div class="text" v-html="feature.feature_content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section v-if="item" class="sc-customer">
        <div class="container">
            <header class="page__header">
                <h2 class="page__header__title">{{ item.post_title }}のクチコミ・レビュー</h2>
            </header><!-- .page-header -->

            <div class="single-lenders__rating d-md-flex">
                <div class="el__col col-md-6">
                    <span class="el__label">評価・レビュー</span>

                    <div class="item__rating ms-sm-3">
                        <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                            <span v-bind:style="{ width:reviews_average }"></span>
                        </div>
                    </div>

                </div>
                <div class="el__col col-md-6">
                    <span class="el__label">口コミ件数</span>
                    <span class="color-secondary">{{ reviews_total }}件</span>
                </div>
            </div>

            <div  class="sc__content wow animate__animated animate__fadeInUp">
                <div v-if="reviews" class="sc-customer__slider slider flickity" data-flickity='{ "autoPlay": false ,"cellAlign": "left", "contain": true, "wrapAround": true, "groupCells": true, "pageDots": false,"prevNextButtons": true }'>
               
                      <div  v-for="item in reviews" class="col-12 col-md-6 el__wrap">
                        <div class="el__item">
                            <div class="el__thumb dnfix__thumb d-none d-sm-block">
                                <img v-bind:src="item.review_image" alt="">
                            </div>
                            <div class="el__meta">
                                <div class="el__meta__mb">
                                    <div class="el__thumb dnfix__thumb d-sm-none">
                                        <img v-bind:src="item.review_image" alt="">
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

                                <div class="el__date">{{ item.item_years }}代 / {{ item.item_gender }}│{{ item.comment_date }}</div>
                                <div class="el__comment text__truncate -n3">{{ item.comment_content }}…</div>
                                <div class="text-end">> 詳しくはこちら</div>
                            </div>
                        </div>
                      </div>
      
                 
                </div>
            </div>
            <div class="text-end">
                <a href="<?= get_the_permalink(12);?>?post_id=<?= $post_id;?>" class="sc__readmore--text">クチコミ一覧を見る<span class="icon-long-arrow-right"></span></a>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
let item_id = '<?= $post_id;?>';
//jQuery( document ).ready( function(){


    var fund_detail_app = new Vue({
        el: '#lending_detail_app',
        data: {
            item: null,
            get_reviews: false,
            reviews: null,
            reviews_total: 0,
            reviews_average: '0%',
            mod_api_url: '<?= $siteurl; ?>/wp-json/crowfunding/reviews'
        },

        mounted () {
            

            axios
            .get('<?= $siteurl; ?>/wp-json/crowfunding/lendings/'+item_id)
            .then( response => {
                this.item = response.data;

                axios
                .get('<?= $siteurl; ?>/wp-json/crowfunding/reviews?post_id='+item_id)
                .then( response => {
                    this.reviews = response.data.items;
                    this.reviews_total = response.data.item_total;
                    this.reviews_average = response.data.item_average;
                }).then( function(response){
                    let obj = jQuery('#lending_detail_app').find('.flickity');
                    if( obj.length > 0 ){
                        let data_flickity = JSON.parse( obj.attr('data-flickity') );
                        obj.flickity( data_flickity );
                    }
                    
                });

            });

        },
    });
//});

</script>
<?php get_footer();?>