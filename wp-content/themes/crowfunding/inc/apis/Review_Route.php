<?php
class Review_Route extends WP_REST_Controller  {

    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crowfunding';
        $this->rest_base = 'reviews';
        $this->post_slug = '';
        $this->home_url  = get_option('siteurl');
        $this->meta_fields = [
            
        ];
        $this->single_meta_fields = array_merge($this->meta_fields,[
            
        ]);
    }

    /**
     * Register Routes
     */
    public function register_routes() {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'index' ],
                    'permission_callback' => [ $this, 'get_items_permission_check' ],
                    'args'                => $this->get_collection_params()
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

        $cols = ['comment_ID','comment_author','comment_date','comment_content'];

        $AppDb->where ("comment_approved",1);
        $items = $AppDb->ObjectBuilder()->get ($wpdb->prefix."comments", null, $cols);

        foreach ($items as $item) {
            $item->review_image     = $this->home_url.'/images/sc-customer-1.png';
            $item->comment_date     = date('d代 女性│Y.m.d');
            $item->item_type        = 'クラウドビルズ';
            $item->item_rating      = '50%';
            $item->item_more_link   = '#';

            if( count($this->meta_fields) ){
                $AppDb->where ("comment_id",$item->comment_ID);
                $AppDb->where ("meta_key",$this->meta_fields,"IN");
                $metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."commentmeta", null, ['meta_key','meta_value']);
                foreach ($metas as $meta) {
                    $item->{$meta->meta_key} = $meta->meta_value;
                }
            }
        }

        return rest_ensure_response( $items );
    }
    /**
     * Create item response
     */
    public function show( $request ) {}
    public function store( $request ){}

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