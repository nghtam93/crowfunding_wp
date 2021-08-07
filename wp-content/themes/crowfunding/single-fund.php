<?php get_header();
$siteurl = get_option('siteurl');
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="<?= $siteurl;?>" class="home"><span>TOP</span></a></span> ＞  
        <span><?= get_the_title();?>の詳細</span>  
    </div>
</div>
<div class="wrap__page" id="fund_detail_app">   
    <div class="container" v-if="product">
        <header class="page__header mb-3">
            <h1 class="page__header__title">{{ product.post_title }} の詳細</h1>
        </header><!-- .page-header -->

        <ul class="single-fund__tag" v-html="product.features_html"></ul>

        <div class="single-fund__main">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <div class="product-gallery">
                        <div class="carousel carousel-main"
                        data-flickity='{
                                "cellAlign": "center",
                                "wrapAround": true,
                                "autoPlay": false,
                                "prevNextButtons":true,
                                "adaptiveHeight": true,
                                "imagesLoaded": true,
                                "lazyLoad": 1,
                                "dragThreshold" : 15,
                                "pageDots": false,
                                "rightToLeft": false
                        }'>
                            <div v-for="gallery in product.gallery" class="carousel-cell">
                                <div class="el__thumb dnfix__thumb">
                                    <a v-href:src="gallery" data-fancybox="group">
                                        <img v-bind:src="gallery" />
                                    </a>
                                </div>
                            </div>
                      
                        </div>
                        
                        <div class="carousel carousel-nav"
                        data-flickity='{
                                "cellAlign": "left",
                                "wrapAround": false,
                                "autoPlay": false,
                                "prevNextButtons": true,
                                "asNavFor": ".carousel-main",
                                "percentPosition": true,
                                "imagesLoaded": true,
                                "pageDots": false,
                                "rightToLeft": false,
                                "contain": true
                            }'
                        >
                            <div v-for="gallery in product.gallery" class="el__col col-3 col-lg-20">
                                <div class="el__thumb dnfix__thumb">
                                    <img v-bind:src="gallery" />
                                </div>
                            </div>
                            
                         
                        </div><!-- .product-thumbnails -->
                    </div> 

                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="single-fund__summary">
                        <ul>
                            <li>
                                <div class="el__label">想定利回り（年利）</div>
                                <div class="el__value">{{ product.fund_values_planned_distribution_rate }}%</div>
                            </li>
                            <li>
                                <div class="el__label">想定運用期間</div>
                                <div class="el__value">{{ product.fund_values_operation_period }}ヶ月</div>
                            </li>
                            <li>
                                <div class="el__label">募集総額</div>
                                <div class="el__value">
                                    {{ product.fund_values_total_offer }}万円
                                    <div class="el__value__sub">
                                        成立下限額 {{ product.fund_values_minimum_amount }}万円

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="el__label">一口出資金額</div>
                                <div class="el__value">{{ product.fund_values_investment_amount }}万円</div>
                            </li>
                            <li>
                                <div class="el__label">初回配当予定日</div>
                                <div class="el__value">{{ product.fund_values_dividend_date }}月</div>
                            </li>
                            <li>
                                <div class="el__label">募集期間</div>
                                <div class="el__value">{{ product.fund_values_recruitment_period }}</div>
                            </li>
                        </ul>
                        <div class="mt-3 text-center">
                            <a href="" class="btn__secondary">クラウドビルズ HPへ</a>
                            <a href="" class="btn__secondary">サービスについて詳細</a>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>

        <div class="single-fund__content">
            <header class="page__header">
                <h2 class="page__header__title">募集概要</h2>
            </header><!-- .page-header -->
            <div class="entry-content">
                <div class="entry-content__text">
                    {{ product.post_content }}
                </div>
                <table class="single-fund__table table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="2">募集総額</td>
                            <td>{{ product.recruitment_outline_total_offer }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">運用タイプ</td>
                            <td>{{ product.recruitment_outline_operation_type }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">募集方式</td>
                            <td>{{ product.recruitment_outline_recruitment_method }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">貸付先数</td>
                            <td>{{ product.recruitment_outline_number_of_lenders }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">予定利回り</td>
                            <td>{{ product.recruitment_outline_expected_yield }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">匿名組合の償還予定日</td>
                            <td>{{ product.recruitment_outline_scheduled_redemption_date }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">募集開始日</td>
                            <td>{{ product.recruitment_outline_recruitment_start_date }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">投資実行日</td>
                            <td>{{ product.recruitment_outline_investment_execution_date }}</td>
                        </tr>
                        <tr>
                            <td rowspan="3">償還方法</td>
                            <td>元本</td>
                            <td>{{ product.recruitment_outline_redemption_method_principal }}</td>
                            </tr>
                            <tr>
                            <td>利益配当</td>
                            <td>{{ product.recruitment_outline_redemption_method_profit_dividend }}</td>
                            </tr>
                            <tr>
                            <td>早期償還</td>
                            <td>{{ product.recruitment_outline_redemption_method_early_redemption }}</td>
                            </tr>
                        <tr>
                            <td colspan="2">償還方法</td>
                            <td>{{ product.recruitment_outline_redemption_method }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">担保</td>
                            <td>{{ product.recruitment_outline_collateral }}</td>
                        </tr>
                      </tbody>
                </table>

                <div class="text-center">
                    <a class="btn btn__primary mb-sm-3">さらに詳細を見る</a>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
let item_id = '<?= get_the_ID();?>';
var fund_detail_app = new Vue({
    el: '#fund_detail_app',
    data: {
        product: null,
    },
    mounted () {
        axios
        .get('<?= $siteurl; ?>/wp-json/crowfunding/funds/'+item_id)
        .then( response => (this.product = response.data) )
        .then( function(response){

            let main_flickity = jQuery.parseJSON( jQuery('.carousel-main').attr('data-flickity') );
            let nav_flickity = jQuery.parseJSON( jQuery('.carousel-nav').attr('data-flickity') );

            jQuery('.carousel-main').flickity( main_flickity );
            jQuery('.carousel-nav').flickity( nav_flickity );
        
        })
        .catch( function(response){
            console.log( 'catch' );
        })
    }
});
</script>
<?php get_footer();?>