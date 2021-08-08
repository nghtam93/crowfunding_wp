<?php
class Lending_Route extends WP_REST_Controller  {

    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crowfunding';
        $this->rest_base_index  = 'lendings';
        $this->rest_base        = 'lendings';
        $this->post_slug = 'lending';
        $this->home_url  = get_option('siteurl');
        $this->meta_fields = [
            'fund_values_guarantee',
            'fund_values_operation_period',
            'fund_values_planned_distribution_rate',
            'fund_values_total_offer',
            'company_business_name',
        ];
    }

    /**
     * Register Routes
     */
    public function register_routes() {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base_index,
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'index' ],
                    'permission_callback' => [ $this, 'get_items_permission_check' ],
                    //'args'                => $this->get_collection_params()
                ],
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [ $this, 'store' ],
                    'permission_callback' => [ $this, 'create_item_permission_check' ],
                    'args'                => $this->get_endpoint_args_for_item_schema(true )
                ]
            ]
        );

        register_rest_route(
            $this->namespace,
            $this->rest_base . '/(?P<id>[\w\-]+)',
            array(
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'show' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => array(
                        'context' => $this->get_context_param( array( 'default' => 'view' ) ),
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => array( $this, 'update' ),
                    'permission_callback' => array( $this, 'update_item_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
                ),
                array(
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => array( $this, 'destroy' ),
                    'permission_callback' => array( $this, 'delete_item_permissions_check' ),
                    'args'                => array(
                        'force' => array(
                            'description' => __( 'Whether to force removal of the widget, or move it to the inactive sidebar.' ),
                            'type'        => 'boolean',
                        ),
                    ),
                ),
                'allow_batch' => array( 'v1' => true ),
                'schema'      => array( $this, 'get_public_item_schema' ),
            )
        );
    }

    /**
     * Get items response
     */
    public function index( $request ) {

        global $AppDb,$wpdb;

        $pagination = ( isset($request['pagination']) ) ? $request['pagination'] : 0;
        $cat_id     = ( isset($request['cat_id']) ) ? $request['cat_id'] : 0;
        $page       = ( isset($request['page']) ) ? $request['page'] : 1;
        $limit      = ( isset($request['limit']) ) ? $request['limit'] : 10;

        $cols = ['ID','post_title','post_name','post_excerpt'];

        $AppDb->where ("post_type",'lending');
        $AppDb->where ("post_status",'publish');
        $totalPages = 1;

        if( $pagination ){
            $AppDb->pageLimit = $limit;
            $items = $AppDb->ObjectBuilder()->paginate($wpdb->prefix."posts as p", $page);
            $totalPages = $AppDb->totalPages;
        }else{
            $items = $AppDb->ObjectBuilder()->get ($wpdb->prefix."posts as p", $limit, $cols);
        }

        foreach ($items as $item) {
            $item->post_link    = $this->home_url.'/'.$this->post_slug.'/'.$item->post_name;
            $item->post_image   = $this->home_url.'/images/company-1.png';

            $features     = get_the_terms($item->ID,'lending_features');
            $item->features_html= '';
            foreach ($features as $feature) {
               //$item->features_html .= '<li><a href="">'.$feature->name.'</a></li>';
               $item->features_html .= '<li>'.$feature->name.'</li>';
            }

            

            $AppDb->where ("post_id",$item->ID);
            $AppDb->where ("meta_key",$this->meta_fields,"IN");
            $metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['meta_key','meta_value']);

            foreach ($metas as $meta) {
                $item->{$meta->meta_key} = $meta->meta_value;
            }
        }

        $return['items']        = $items;
        $return['totalPages']   = $totalPages;

        return rest_ensure_response( $return );
    }


    public function store( $request ) {

        // Data validation
        $firstname = isset( $request['firstname'] ) ? sanitize_text_field( $request['firstname'] ): '';
        $lastname  = isset( $request['lastname'] ) ? sanitize_text_field( $request['lastname'] )  : '';
        $email     = isset( $request['email'] ) && is_email( $request['email'] ) ? sanitize_email( $request['email'] ) : '';

        // Save option data into WordPress
        update_option( 'wpvk_settings_firstname', $firstname );
        update_option( 'wpvk_settings_lastname', $lastname );
        update_option( 'wpvk_settings_email', $email );

        $response = [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email
        ];

        return rest_ensure_response( $response );
        
    }

    /* photos */
    public function get_items_permission_check( $request ) {
        // if( current_user_can( 'administrator' ) ) {
        //     return true;
        // }
        return true;
    }
    /* photos/:id */
    public function get_item_permissions_check( $request ) {
        return true;
    }
    /* photos:store */
    public function create_item_permission_check( $request ) {
        return true;
    }
    /* photos:update */
    public function update_item_permissions_check( $request ) {
        return true;
    }
    /* photos:destroy */
    public function delete_item_permissions_check( $request ) {
        return true;
    }

    /**
     * Retrives the query parameters for the items collection
     */
    public function get_collection_params() {
        return [];
    }

}