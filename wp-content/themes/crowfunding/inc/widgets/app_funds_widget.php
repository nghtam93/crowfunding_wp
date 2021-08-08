<?php
class App_Funds_Widget extends WP_Widget {
	public function __construct() {
		$this->widget_cssclass    = '';
		$this->widget_description = '[Theme] List Funds';
		$this->widget_id          = 'app_funds_widget';
		$this->widget_name        = __( '[Theme] List Funds', 'crowfunding' );
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

	                <div v-if="items"
	                	v-for="item in items" class="product__item ef--zoomin">
	                    <div class="row">
	                        <div class="col-md-5 col-lg-34 wow animate__animated animate__fadeInLeft">
	                            <a v-bind:href="item.post_link" class="el__thumb dnfix__thumb">
	                                <div class="el__status">募集中</div>
	                                <img v-bind:src="item.post_image" alt="">
	                            </a>
	                        </div>
	                        <div class="col-md-7 col-lg-66 wow animate__animated animate__fadeInRight">
	                            <h3 class="el__title text-truncate"><a v-bind:href="item.post_link">{{ item.post_title }}</a></h3>
	                            <div class="d-flex">
	                                <span class="me-3">{{ item.company_business_name }}</span>
	                                <span>({{ item.comment_count }}件のクチコミ）</span>
	                            </div>
	                            <ul class="el__tag" v-html="item.features_html"></ul>
	                            <div class="el__sub text__truncate">
	                                {{ item.post_excerpt }}...
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
		                                <p>{{ item.fund_values_guarantee }}</p>
		                            </li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	                <div v-else>
					  Loading
					</div>

	                <div class="text-center pt-3">
	                    <a v-bind:href="more_url" class="sc__readmore btn btn__primary">ファンド一覧/検索</a>
	                </div>
	            </div>
	        </div>
	    </section>
	    <script type="text/javascript">
	        var social_lending_app = new Vue({
	          el: '#<?= $args['widget_id']; ?>',
	          data: {
	            items: null,
	            mod_title: '<?= $instance['title']; ?>',
	            mod_sub_title: '<?= $instance['sub_title']; ?>',
	            mod_limit: '<?= $instance['limit']; ?>',
	            more_url: '<?= $instance['more_url']; ?>',
	            mod_api_url: '<?= $this->home_url; ?>/wp-json/crowfunding/funds'
	          },
	          mounted () {
			    axios
			      .get(this.mod_api_url + '?limit='+this.mod_limit)
			      .then( response => (this.items = response.data.items) )
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
			'more_url' => [
				'label' => 'More Url',
				'type' => 'text',
				'value' => ( empty($instance['more_url']) ) ? '' : $instance['more_url'],
			]
		];
		return $fields;
	}
}