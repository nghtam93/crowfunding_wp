<?php
class App_Reviews_Widget extends WP_Widget {
	public function __construct() {
		$this->widget_cssclass    = '';
		$this->widget_description = '[Theme] List Reviews';
		$this->widget_id          = 'app_reviews_widget';
		$this->widget_name        = __( '[Theme] List Reviews', 'crowfunding' );
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
		<section class="sc-customer" id="<?= $args['widget_id']; ?>">
	        <div class="container">
	            <header class="sc__header text-center wow animate__animated animate__pulse">
	                <h2 class="sc__header__title">{{ mod_title }}</h2>
	                <p class="sc__header__sub">{{ mod_sub_title }}</p>
	            </header>
	            <div class="sc__content wow animate__animated animate__fadeInUp">
	                <div v-if="items" class="sc-customer__slider slider flickity" data-flickity='{ "autoPlay": false ,"cellAlign": "left", "contain": true, "wrapAround": true, "groupCells": true, "pageDots": false,"prevNextButtons": true }'>
	               
	                      <div v-for="item in items" class="col-12 col-md-6 el__wrap">
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
	                                        <h3 class="el__title">{{ item.item_type }}</h3>
	                                        <div class="item__rating ms-sm-3">
	                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
	                                                <span v-bind:style="{ width:item.item_rating }"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="el__date">{{ item.comment_date }}</div>
	                                <div class="el__comment text__truncate -n3">{{ item.comment_content }}…</div>
	                                <div class="text-end">
	                                	<a v-bind:href="item.item_more_link">> 詳しくはこちら</a>
	                                </div>
	                            </div>
	                        </div>
	                      </div>

	                 
	                </div>
	            </div>
	            <div class="text-end">
	                <a v-bind:href="mod_more_url" class="sc__readmore--text">クチコミ一覧を見る<span class="icon-long-arrow-right"></span></a>
	            </div>
	        </div>
	    </section>
	    <script type="text/javascript">
	        var social_reviews_app = new Vue({
	          el: '#<?= $args['widget_id']; ?>',
	          data: {
	            items: null,
	            mod_title: '<?= $instance['title']; ?>',
	            mod_sub_title: '<?= $instance['sub_title']; ?>',
	            mod_limit: '<?= $instance['limit']; ?>',
	            mod_more_url: '<?= $instance['more_url']; ?>',
	            mod_api_url: '<?= $this->home_url; ?>/wp-json/crowfunding/reviews'
	          },
	          mounted () {
			    axios
			      .get(this.mod_api_url + '?limit='+this.mod_limit)
			      .then( response => (this.items = response.data) )
			      .then( function(response){
			      	let obj = jQuery('#<?= $args['widget_id']; ?>').find('.flickity');
			      	let data_flickity = jQuery.parseJSON( obj.attr('data-flickity') );
		            obj.flickity( data_flickity );
			      })
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
				'value' => ( empty($instance['title']) ) ? 'クチコミ' : $instance['title'],
			],
			'sub_title' => [
				'label' => 'Sub title',
				'type' => 'text',
				'value' => ( empty($instance['sub_title']) ) ? 'Customer Voice' : $instance['sub_title'],
			],
			'limit' => [
				'label' => 'Limit',
				'type' => 'text',
				'value' => ( empty($instance['limit']) ) ? 4 : $instance['limit'],
			],
			'more_url' => [
				'label' => 'More Url',
				'type' => 'text',
				'value' => ( empty($instance['more_url']) ) ? '' : $instance['more_url'],
			]
		];
		return $fields;
	}
}