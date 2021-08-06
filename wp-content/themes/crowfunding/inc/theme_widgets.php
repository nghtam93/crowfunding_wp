<?php
include_once dirname( __FILE__ ).'/widgets/app_funds_widget.php';
include_once dirname( __FILE__ ).'/widgets/app_lendings_widget.php';
function app_register_widget() {
	register_widget( 'App_Funds_Widget' );
	register_widget( 'App_Lendings_Widget' );

}
add_action( 'widgets_init', 'app_register_widget' );