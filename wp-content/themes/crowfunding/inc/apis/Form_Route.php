<?php
class Form_Route extends WP_REST_Controller  {

    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crowfunding';
        $this->rest_base = 'forms';
        $this->post_slug = 'fund';
        $this->home_url  = get_option('siteurl');
        $this->meta_fields = [];
        $this->single_meta_fields = array_merge($this->meta_fields,[]);
    }

    /**
     * Register Routes
     */
    public function register_routes() {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base.'/get_business',
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_business' ],
                    'permission_callback' => [ $this, 'get_items_permission_check' ],
                    'args'                => $this->get_collection_params()
                ]
            ]
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base.'/get_services',
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_services' ],
                    'permission_callback' => [ $this, 'get_items_permission_check' ],
                    'args'                => $this->get_collection_params()
                ]
            ]
        );


    }

    public function get_services( $request ) {
        global $AppDb,$wpdb;
        $AppDb->where ("meta_key","company_service_title");
        //$AppDb->where ("meta_key","company_business_name");
        $AppDb->where ("meta_value","","!=");
        $AppDb->groupBy ("meta_value");
        $results  = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['meta_value']);

        $items = [];
        if( count($results) ){
            foreach ($results as $result) {
                $items[] = $result->meta_value;
            }
        }
        $return['items'] = $items;
        return rest_ensure_response( $return );
    }
    public function get_business( $request ) {
        global $AppDb,$wpdb;
        $AppDb->where ("meta_key","company_business_name");
        $AppDb->where ("meta_value","","!=");
        $AppDb->groupBy ("meta_value");
        $results  = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['meta_value']);

        $items = [];
        if( count($results) ){
            foreach ($results as $result) {
                $items[] = $result->meta_value;
            }
        }
        $return['items'] = $items;
        return rest_ensure_response( $return );
    }

    /* photos */
    public function get_items_permission_check( $request ) {
        // if( current_user_can( 'administrator' ) ) {
        //     return true;
        // }
        return true;
    }
    /* photos/:id */
    public function get_item_permissions_check( $request ) { return true;  }
    /* photos:store */
    public function create_item_permission_check( $request ) { return true;  }
    /* photos:update */
    public function update_item_permissions_check( $request ) { return true; }
    /* photos:destroy */
    public function delete_item_permissions_check( $request ) { return true;  }

    /**
     * Retrives the query parameters for the items collection
     */
    public function get_collection_params() { return []; }

}