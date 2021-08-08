<?php
include_once dirname( __FILE__ ).'/widgets/app_funds_widget.php';
include_once dirname( __FILE__ ).'/widgets/app_lendings_widget.php';
include_once dirname( __FILE__ ).'/widgets/app_news_widget.php';
include_once dirname( __FILE__ ).'/widgets/app_reviews_widget.php';
include_once dirname( __FILE__ ).'/widgets/app_banner_widget.php';
include_once dirname( __FILE__ ).'/widgets/app_tags_widget.php';
function app_register_widget() {
	register_widget( 'App_Funds_Widget' );
	register_widget( 'App_Lendings_Widget' );
	register_widget( 'App_News_Widget' );
	register_widget( 'App_Reviews_Widget' );
	register_widget( 'App_Banner_Widget' );
	register_widget( 'App_Tags_Widget' );

}
add_action( 'widgets_init', 'app_register_widget' );