<?php
include dirname(__FILE__).'/MysqliDb.php';
global $AppDb;
$AppDb = new MysqliDb (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
include dirname(__FILE__).'/apis/Fund_Route.php';

add_action( 'rest_api_init', 'theme_register_routes' );
function theme_register_routes(){
	( new Fund_Route() )->register_routes();
}