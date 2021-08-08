<?php
class App_Banner_Widget extends WP_Widget {
	public function __construct() {
		$this->widget_cssclass    = '';
		$this->widget_description = '[Theme] Banner';
		$this->widget_id          = 'app_banner_widget';
		$this->widget_name        = __( '[Theme] Banner', 'crowfunding' );
		$this->home_url 		  = get_option('siteurl');

		$widget_ops = array(
			'classname'                   => $this->widget_cssclass,
			'description'                 => $this->widget_description,
			'customize_selective_refresh' => true,
		);
		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
	}
	public function widget( $args, $instance ) {

		$title 	= $instance['title'];
		$html 	= $args['before_widget'];
		//$html .= $args['before_title'] . $title . $args['after_title'];
		ob_start();
		?>
	    <section class="sc-banner" id="<?= $args['widget_id']; ?>">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-6 animate__animated animate__backInLeft">
	                    <header class="el__header">
	                        <h2 class="el__header__title">{{ mod_title }}</h2>
	                        <p class="el__header__sub">{{ mod_sub_title }}</p>
	                    </header>
	                    <div class="el__img">
	                        <img v-bind:src="image" alt="">
	                    </div>
	                </div>
	                <div class="col-md-6 animate__animated animate__backInRight">
	                    <div class="box__advanced__search">
	                        <div class="box__header">
	                            <p class="box__header__title">- {{ form_title }} - </p>
	                        </div>
	                        <form v-bind:action="more_url" class="box__content">
	                            <div class="mb-3 row">
	                                <label for="" class="col-sm-3 col-form-label">事業者名</label>
	                                <div class="col-sm-9">
	                                	<select name="business_name" class="form-control">
	                                		<option value=""> </option>
	                                		<option v-for="company in companies" v-bind:value="company">{{ company }}</option>
	                                	</select>
	                                </div>
	                            </div>
	                            <div class="mb-3 row">
	                                <label for="" class="col-sm-3 col-form-label">利回り</label>
	                                <div class="col-sm-9">
	                                <input type="text" class="js-range-slider" 
	                                name="yield" 
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
	                                        name="guarantee[]">
	                                        <label class="form-check-label" for="g_ja">保証あり</label>
	                                      </div>
	                                      <div class="form-check form-check-inline">
	                                        <input class="form-check-input" type="checkbox" id="g_nee" value="1" name="guarantee[]">
	                                        <label class="form-check-label" for="g_nee">保証なし</label>
	                                      </div>
	                                </div>
	                            </div>
	                            <div class="text-center mt-4">
	                                <button type="submit" class="btn btn__primary mb-sm-3">検索する</button>
	                            </div>
	                        </form>

	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    <script type="text/javascript">
	        var social_banner_app = new Vue({
          		el: '#<?= $args['widget_id']; ?>',
          		data: {
		            companies: null,
		            mod_title: '<?= $instance['title']; ?>',
		            mod_sub_title: '<?= $instance['sub_title']; ?>',
		            image: '<?= $instance['image']; ?>',
		            form_title: '<?= $instance['form_title']; ?>',
		            more_url: '<?= $instance['more_url']; ?>',
	             	mod_api_url: '<?= $this->home_url; ?>/wp-json/crowfunding/forms/get_companies'
	          	},
	          	mounted () {
			    	axios
			      	.get(this.mod_api_url + '?limit='+this.mod_limit)
			      	.then( response => (this.companies = response.data.items) )
		  		}
	        });
	        
	    </script>
		<?php
		$html .= ob_get_clean();
		$html .= $args['after_widget'];
		echo $html;
	}

	public function form( $instance ) {
		$fields = $this->_get_fields($instance);
		?>
		<?php foreach ($fields as $f_name => $f_arr): ?>
		<p>
			<?php if( $f_arr['type'] == 'text' ):?>
				<label for="<?php echo $this->get_field_id( $f_name ); ?>">
					<?= $f_arr['label']; ?>
				</label>

				<input class="widefat" id="<?php echo $this->get_field_id( $f_name ); ?>" name="<?php echo $this->get_field_name( $f_name ); ?>" type="text" value="<?= $f_arr['value']; ?>" />
			<?php endif;?>

			<?php if( $f_arr['type'] == 'checbox' ):?>
				<input class="checkbox " id="<?php echo $this->get_field_id( $f_name ); ?>" name="<?php echo $this->get_field_name( $f_name ); ?>" type="checkbox" value="1" <?php checked( $instance[$f_name] , 1 ); ?> >
				<label for="<?php echo $this->get_field_id( $f_name ); ?>"><?= $f_arr['label']; ?></label>
			<?php endif;?>

			<?php if( $f_arr['type'] == 'select' ):?>
				<label for="<?php echo $this->get_field_id( $f_name ); ?>">
					<?= $f_arr['label']; ?>
				</label>

				<select class="widefat"  id="<?php echo $this->get_field_id( $f_name ); ?>" name="<?php echo $this->get_field_name( $f_name ); ?>">
					<?php foreach( $f_arr['options'] as $option ):?>
					<option value="<?= $option['key'];?>" <?php selected( $instance[$f_name] , $option['key'] ); ?>><?= $option['value'];?></option>
					<?php endforeach;?>
				</select>
			<?php endif;?>
		</p>
		<?php endforeach;?>


		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->_get_fields() as $f_name => $f_arr){
			$instance[$f_name] = ( ! empty( $new_instance[$f_name] ) ) ? strip_tags( $new_instance[$f_name] ) : '';
		}
		return $instance;
	}

	private function _get_fields( $instance = [] ){
		$fields = [
			'title' => [
				'label' => 'Title',
				'type' => 'text',
				'value' => ( empty($instance['title']) ) ? '' : $instance['title'],
			],
			'sub_title' => [
				'label' => 'Sub title',
				'type' => 'text',
				'value' => ( empty($instance['sub_title']) ) ? '' : $instance['sub_title'],
			],
			'image' => [
				'label' => 'Image',
				'type' => 'text',
				'value' => ( empty($instance['image']) ) ? '' : $instance['image'],
			],
			'form_title' => [
				'label' => 'Form title',
				'type' => 'text',
				'value' => ( empty($instance['form_title']) ) ? '' : $instance['form_title'],
			],
			'limit' => [
				'label' => 'Limit',
				'type' => 'text',
				'value' => ( empty($instance['limit']) ) ? 4 : $instance['limit'],
			],
			'more_url' => [
				'label' => 'Form Url',
				'type' => 'text',
				'value' => ( empty($instance['more_url']) ) ? '' : $instance['more_url'],
			]
		];
		return $fields;
	}
}