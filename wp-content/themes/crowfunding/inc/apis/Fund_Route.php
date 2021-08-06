<?php
class Fund_Route extends WP_REST_Controller  {

    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crowfunding';
        $this->rest_base_index = 'funds';
        $this->post_slug = 'fund';
        $this->home_url  = get_option('siteurl');
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
                    //'permission_callback' => [ $this, 'get_items_permission_check' ],
                    //'args'                => $this->get_collection_params()
                ],
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [ $this, 'store' ],
                    'permission_callback' => [ $this, 'create_items_permission_check' ],
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

        $cols = ['ID','post_title','post_name','post_excerpt'];

        $AppDb->where ("post_type",'fund');
        $AppDb->where ("post_status",'publish');
        $items = $AppDb->ObjectBuilder()->get ($wpdb->prefix."posts", null, $cols);

        foreach ($items as $key => $item) {
            $item->post_link    = $this->home_url.'/'.$this->post_slug.'/'.$item->post_name;
            $item->post_image   = $this->home_url.'/images/product-1.png';
        }

        return rest_ensure_response( $items );
    }

    /**
     * Get items permission check
     */
    public function get_items_permission_check( $request ) {
        // if( current_user_can( 'administrator' ) ) {
        //     return true;
        // }

        return true;
    }

    /**
     * Create item response
     */
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

    /**
     * Create item permission check
     */
    public function create_items_permission_check( $request ) {
        return true;
    }

    /**
     * Retrives the query parameters for the items collection
     */
    public function get_collection_params() {
        return [];
    }

}