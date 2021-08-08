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
            	@submit="checkForm"
            	action="" class="box__content">
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">性別 :</label>
                    <div class="input-group-lg col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="item_gender" id="male" value="male" checked>
                            <label class="form-check-label" for="male">男性</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="item_gender" id="female" value="female">
                            <label class="form-check-label" for="female">女性</label>
                          </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">年代 :</label>
                    <div class="input-group-lg col-sm-9">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>20代</option>
                            <option value="1">20代</option>
                            <option value="2">20代</option>
                            <option value="3">20代</option>
                          </select>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">評価 :</label>
                    <div class="input-group-lg col-sm-9 d-flex align-items-center">
                        <div class="rateit -icomoon d-flex align-items-center" data-rateit-starwidth="25" data-rateit-starheight="25"></div> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">事業者名 :</label>
                    <div class="input-group-lg col-sm-9">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>クラウドビルズ</option>
                            <option value="1">クラウドビルズ</option>
                            <option value="2">クラウドビルズ</option>
                            <option value="3">クラウドビルズ</option>
                          </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">サービス名 :</label>
                    <div class="input-group-lg col-sm-9">
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">口コミ :</label>
                    <div class="col-sm-9">
                        <textarea name="" id="editor" class="form-control" cols="30" rows="10"></textarea>
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
	    errors: [],
	    name: null,
	    age: null,
	    movie: null
  	},
  	methods:{
    	checkForm: function (e) {
			if (this.name && this.age) {
				return true;
			}

			this.errors = [];

			if (!this.name) {
				this.errors.push('Name required.');
			}
			if (!this.age) {
				this.errors.push('Age required.');
			}

			e.preventDefault();
	    }
  	}
});
</script>
<?php get_footer(); ?>