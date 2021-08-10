<?php
/**
 * Template Name: Page (Review Add)
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
        <span><?php the_title();?></span>
    </div>
</div>
<div class="wrap__page">   
    <div class="">
        <div class="container">
            <header class="page__header">
                <h1 class="page__header__title">口コミを投稿する</h1>
            </header><!-- .page-header -->
        </div>
        <div class="inquiry__box mx-auto">
            <form 
            	id="app_form_add_review" 
            	@submit.prevent="submitForm"
            	action="" class="box__content">
                <div v-if="isSubmited" class="mb-3">
                    Submited
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">性別 :</label>
                    <div class="input-group-lg col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="form.item_gender" id="male" value="male" :checked="1">
                            <label class="form-check-label" for="male">男性</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="form.item_gender" id="female" value="female">
                            <label class="form-check-label" for="female">女性</label>
                          </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">年代 :</label>
                    <div class="input-group-lg col-sm-9">
                        <select class="form-select" v-model="form.item_years">
                            <option value="20" selected>20代</option>
                            <option value="30">30代</option>
                            <option value="40">40代</option>
                            <option value="50">50代</option>
                          </select>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">評価 :</label>
                    <div class="input-group-lg col-sm-9 align-items-center">
                        <div class="rateit -icomoon d-flex align-items-center" data-rateit-starwidth="25" data-rateit-starheight="25"></div> 
                        <p v-if="errors.item_rating" class="help-text error">This field is required</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">事業者名 :</label>
                    <div class="input-group-lg col-sm-9">
                        <select v-if="business" v-model="form.business_name" class="form-control">
                            <option value=""> </option>
                            <option v-for="company in business" v-bind:value="company">{{ company }}</option>
                        </select>
                        <p v-if="errors.business_name" class="help-text error">This field is required</p>
                    </div>
                    
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">サービス名 :</label>
                    <div class="input-group-lg col-sm-9">
                        <select v-if="services" v-model="form.service_name" class="form-control">
                            <option value=""> </option>
                            <option v-for="service in services" v-bind:value="service">{{ service }}</option>
                        </select>
                        <p v-if="errors.service_name" class="help-text error">This field is required</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">口コミ :</label>
                    <div class="col-sm-9">
                        <textarea v-model="form.content" id="editor" class="form-control" cols="30" rows="10"></textarea>
                        <p v-if="errors.content" class="help-text error">This field is required</p>
                    </div>
                </div>
                <div class="input-group-lg text-center mt-4">
                    <button type="submit" class="btn btn__primary -small">投稿する</button>
                </div>
            </form>

        </div>

    </div>
</div>
<script type="text/javascript">
const app = new Vue({
  	el: '#app_form_add_review',
  	data: {
	    business: null,
        services: null,
        can_submit: true,
        isSubmiting: false,
        isSubmited: false,
        form : {
            item_gender : 'male',
            item_years : 20,
            item_rating : 0,
            business_name : '',
            service_name : '',
            content : '',
        },
        errors: {
            business_name : false,
            service_name : false,
            content : false,
            item_rating : false,
        },
        business_api_url: '<?= $siteurl; ?>/wp-json/crowfunding/forms/get_business',
        service_api_url: '<?= $siteurl; ?>/wp-json/crowfunding/forms/get_services',
        mod_api_url: '<?= $siteurl; ?>/wp-json/crowfunding/reviews',
  	},
  	methods:{
    	submitForm: function (e) {
            this.form.item_rating = jQuery('.rateit').rateit('value');
			this.errors = [];

            this.can_submit = true;
            if( this.form.item_rating == 0 ){
                this.errors.item_rating = true;
                this.can_submit = false;
            }

            if( this.form.business_name == "" ){
                this.errors.business_name = true;
                this.can_submit = false;
            }

            if( this.form.service_name == "" ){
                this.errors.service_name = true;
                this.can_submit = false;
            }

            if( this.form.content == "" ){
                this.errors.content = true;
                this.can_submit = false;
            }

            if( this.can_submit ){

                this.isSubmiting = true;

                const formData = new FormData()
                Object.keys(this.form).forEach((key) => {
                    formData.append(key, this.form[key])
                })

                axios
                .post(this.mod_api_url, formData )
                .then( response => {
                    this.isSubmiting    = false;
                    this.isSubmited     = true;
                });
            }
	    }
  	},
    mounted () {
        axios
        .get(this.business_api_url)
        .then( response => (this.business = response.data.items) );

        axios
        .get(this.service_api_url)
        .then( response => (this.services = response.data.items) );
    }
});
</script>
<?php get_footer(); ?>