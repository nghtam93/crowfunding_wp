<?php
class App_Boxes_Widget extends WP_Widget {
	public function __construct() {
		$this->widget_cssclass    = '';
		$this->widget_description = '[Theme] Boxes';
		$this->widget_id          = 'app_boxes_widget';
		$this->widget_name        = __( '[Theme] Boxes', 'crowfunding' );
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
		$tags = get_terms( array('taxonomy' => 'post_tag', 'hide_empty' => false) );
		?>
	    <section class="sc-3box">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex wow animate__animated animate__fadeInLeft">
                        <div class="el__item">
                        	<div class="el__item">
	                        	<?php if( $instance['box_1_title'] ):?>
									<h3 class="el__title"><?= $instance['box_2_title']; ?></h3>
	                        	<?php endif;?>
	                        	<?php if( $instance['box_1_content'] ):?>
	                        		<div class="d-flex">
		                                <div class="el__excerpt flex-grow-1">
		                                    <?= $instance['box_1_content']; ?>
		                                </div>
		                                <div class="el__icon">
		                                	<a href="<?= $instance['box_1_url']; ?>">
			                                    <span class="icon-long-arrow-right"></span>
			                                </a>
		                                </div>
		                            </div>
	                        	<?php endif;?>
	                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex wow animate__animated animate__fadeInUp">
                        <div class="el__item">
                        	<?php if( $instance['box_2_title'] ):?>
								<h3 class="el__title"><?= $instance['box_2_title']; ?></h3>
                        	<?php endif;?>
                        	<?php if( $instance['box_2_content'] ):?>
                        		<div class="d-flex">
	                                <div class="el__excerpt flex-grow-1">
	                                    <?= $instance['box_2_content']; ?>
	                                </div>
	                                <div class="el__icon">
	                                	<a href="<?= $instance['box_2_url']; ?>">
		                                    <span class="icon-long-arrow-right"></span>
		                                </a>
	                                </div>
	                            </div>
                        	<?php endif;?>
                        </div>
                    </div>
                    <div class="col-md-4 wow animate__animated animate__fadeInRight">
                        <div class="el__item -text">
                            <h3 class="el__title"><?= $instance['box_3_title']; ?></h3>
                            <div class="d-flex">
                                <div class="el__excerpt flex-grow-1">
                                    <?= $instance['box_3_content']; ?>
                                </div>
                                <div class="el__icon">
                                	<a href="<?= $instance['box_3_url']; ?>">
	                                    <span class="icon-long-arrow-right"></span>
	                                </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

			<?php if( $f_arr['type'] == 'textarea' ):?>
				<label for="<?php echo $this->get_field_id( $f_name ); ?>">
					<?= $f_arr['label']; ?>
				</label>

				<textarea class="widefat" id="<?php echo $this->get_field_id( $f_name ); ?>" name="<?php echo $this->get_field_name( $f_name ); ?>" /><?= $f_arr['value']; ?></textarea>
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
			'box_1_title' => [
				'label' => 'Box 1 title',
				'type' => 'text',
				'value' => ( empty($instance['box_1_title']) ) ? '' : $instance['box_1_title'],
			],
			'box_1_content' => [
				'label' => 'Box 1 content',
				'type' => 'textarea',
				'value' => ( empty($instance['box_1_content']) ) ? '' : $instance['box_1_content'],
			],
			'box_1_url' => [
				'label' => 'Box 1 url',
				'type' => 'text',
				'value' => ( empty($instance['box_1_url']) ) ? '' : $instance['box_1_url'],
			],
			'box_2_title' => [
				'label' => 'Box 2 title',
				'type' => 'text',
				'value' => ( empty($instance['box_2_title']) ) ? '' : $instance['box_2_title'],
			],
			'box_2_content' => [
				'label' => 'Box 2 content',
				'type' => 'textarea',
				'value' => ( empty($instance['box_2_content']) ) ? '' : $instance['box_2_content'],
			],
			'box_2_url' => [
				'label' => 'Box 2 url',
				'type' => 'text',
				'value' => ( empty($instance['box_2_url']) ) ? '' : $instance['box_2_url'],
			],
			'box_3_title' => [
				'label' => 'Box 3 title',
				'type' => 'text',
				'value' => ( empty($instance['box_3_title']) ) ? '' : $instance['box_3_title'],
			],
			'box_3_content' => [
				'label' => 'Box 3 content',
				'type' => 'textarea',
				'value' => ( empty($instance['box_3_content']) ) ? '' : $instance['box_3_content'],
			],
			'box_3_url' => [
				'label' => 'Box 3 url',
				'type' => 'text',
				'value' => ( empty($instance['box_3_url']) ) ? '' : $instance['box_3_url'],
			]
		];
		return $fields;
	}
}