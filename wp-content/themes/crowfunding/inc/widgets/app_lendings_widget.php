<?php
class App_Lendings_Widget extends WP_Widget {
	public function __construct() {
		$this->widget_cssclass    = '';
		$this->widget_description = '[Theme] List Lending';
		$this->widget_id          = 'app_lending_widget';
		$this->widget_name        = __( '[Theme] List Lending', 'crowfunding' );
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
	    <section class="sc-lending" id="<?= $args['widget_id']; ?>">
	        <div class="container">
	            <header class="sc__header text-center wow animate__animated animate__pulse">
	                <h2 class="sc__header__title">{{ mod_title }}</h2>
	                <p class="sc__header__sub">{{ mod_sub_title }}</p>
	            </header>
	            <div class="sc__content wow animate__animated animate__fadeInUp">
	                <div class="new__slider flickity" data-flickity='{ "autoPlay": true ,"cellAlign": "left", "contain": true, "wrapAround": true, "groupCells": true, "pageDots": false,"prevNextButtons": true }'>
	                    <div v-for="item in products" class="col-12 col-md-6 col-lg-4 el__col">
	                        <div class="new__item ef--zoomin">
	                            <a href="" class="el__thumb dnfix__thumb">
	                                <img src="images/company-1.png" alt="">
	                            </a>
	                            <div class="el__meta">
	                                <div class="el__company">株式会社フィンスター</div>
	                                <h3 class="el__title text__truncate"><a href="">{{ item.post_title }}</a></h3>

	                                <ul class="el__tag">
	                                    <li>1万円より</li>
	                                    <li>償還時配当</li>
	                                    <li>抽選式</li>
	                                </ul>
	                                <div class="el__sub text__truncate -n2">
	                                    サンプルテキストサンプルテキストサンプルテキストサンプルテキスト…
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="text-end">
	                    <a href="" class="sc__readmore--text">ソーシャルレンディング事業者一覧を見る<span class="icon-long-arrow-right"></span></a>
	                </div>
	            </div>
	        </div>
	    </section>
	    <script type="text/javascript">
	        var social_lending_app = new Vue({
	          el: '#<?= $args['widget_id']; ?>',
	          data: {
	            products: null,
	            mod_title: '<?= $instance['title']; ?>',
	            mod_sub_title: '<?= $instance['sub_title']; ?>',
	          },
	          mounted () {
			    axios
			      .get('<?= $this->home_url; ?>/wp-json/crowfunding/lendings')
			      .then( response => (this.products = response.data) )
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
				'value' => ( empty($instance['title']) ) ? 'ソーシャルレンディング' : $instance['title'],
			],
			'sub_title' => [
				'label' => 'Sub title',
				'type' => 'text',
				'value' => ( empty($instance['sub_title']) ) ? 'COLUM' : $instance['sub_title'],
			],
			'limit' => [
				'label' => 'Limit',
				'type' => 'text',
				'value' => ( empty($instance['limit']) ) ? 4 : $instance['limit'],
			],
		];
		return $fields;
	}
}