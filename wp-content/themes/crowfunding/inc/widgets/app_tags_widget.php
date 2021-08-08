<?php
class App_Tags_Widget extends WP_Widget {
	public function __construct() {
		$this->widget_cssclass    = '';
		$this->widget_description = '[Theme] Tags';
		$this->widget_id          = 'app_tags_widget';
		$this->widget_name        = __( '[Theme] Tags', 'crowfunding' );
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
	    <section class="sc-tag" id="<?= $args['widget_id']; ?>">
        <div class="container">
            <header class="sc-tag__header text-center">
                <h2 class="sc-tag__header__title">{{ mod_title }}</h2>
            </header>
            <ul class="sc-tag__list wow animate__animated animate__fadeInUp">
                <li><a href="">不動産投資</a></li>
                <li><a href="">ソーシャルレンディング</a></li>
                <li><a href="">クラウドファンディング</a></li>
                <li><a href="">利回り</a></li>
                <li><a href="">S T O</a></li>
                <li><a href="">マネタイズ</a></li>
                <li><a href="">投資利回り</a></li>
                <li><a href="">クラウドファンディング</a></li>
                <li><a href="">利回り</a></li>
                <li><a href="">S T O</a></li>
                <li><a href="">マネタイズ</a></li>
            </ul>
            <div class="text-end">
                <a v-bind:href="item.item_more_link" class="sc__readmore--text">全てのタグを見る<span class="icon-long-arrow-right"></span></a>
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
	            mod_api_url: '<?= $this->home_url; ?>/wp-json/crowfunding/tags'
	          },
	          mounted () {
			    // axios
			    //   .get(this.mod_api_url + '?limit='+this.mod_limit)
			    //   .then( response => (this.items = response.data) )
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