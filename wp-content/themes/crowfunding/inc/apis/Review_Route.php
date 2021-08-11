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
            'item_gender',
            'item_years',
            'item_rating',
            'business_name',
            'service_name',
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

        $pagination = ( isset($request['pagination']) ) ? $request['pagination'] : 0;
        $post_id     = ( isset($request['post_id']) ) ? $request['post_id'] : 0;
        $page       = ( isset($request['page']) ) ? $request['page'] : 1;
        $limit      = ( isset($request['limit']) ) ? $request['limit'] : 10;

        $cols = ['comment_ID','comment_author','comment_date','comment_content'];

        $AppDb->where ("comment_approved",1);

        if($post_id){
            $AppDb->where ("comment_post_ID",$post_id);
        }
        
        $totalPages = 1;
        if( $pagination ){
            $AppDb->pageLimit = $limit;
            $items = $AppDb->ObjectBuilder()->paginate($wpdb->prefix."comments", $page,$cols);
            $totalPages = $AppDb->totalPages;
        }else{
            $items = $AppDb->ObjectBuilder()->get ($wpdb->prefix."comments", $limit, $cols);
        }

        $values = [];
        if( count($items)  > 0 ){
            foreach ($items as $item) {
                
                $item->comment_date     = date('Y/m/d',strtotime($item->comment_date));

                if( count($this->meta_fields) ){
                    $AppDb->where ("comment_id",$item->comment_ID);
                    $AppDb->where ("meta_key",$this->meta_fields,"IN");
                    $metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."commentmeta", null, ['meta_key','meta_value']);
                    foreach ($metas as $meta) {
                        $item->{$meta->meta_key} = $meta->meta_value;
                    }
                }
                $item->review_image     = $this->home_url.'/wp-content/themes/crowfunding/images/'.$item->item_gender.'.png';
                $item->item_type        = 'クラウドビルズ';
                $item->item_rating_value = $item->item_rating;
                $item->item_rating      = ( $item->item_rating / 5 ) * 100 .'%';
                $item->item_more_link   = '#';
                $item->item_gender = ($item->item_gender == 'male') ? '男性' : '女性';

                $values[] = $item->item_rating_value;
            }
            $item_total = count($items);
            $item_average = ( array_sum($values)/count($items) / 5 ) * 100 .'%';
        }else{
            $items = null;
            $item_total = 0;
            $item_average = 0;
        }

        $return['items']        = $items;
        $return['totalPages']   = $totalPages;
        $return['item_total']   = $item_total;
        $return['item_average'] = $item_average;

        return rest_ensure_response( $return );
    }
    /**
     * Create item response
     */
    public function show( $request ) {}
    public function store( $request ){

        $item_gender    = $request['item_gender'];
        $item_years     = $request['item_years'];
        $item_rating    = $request['item_rating'];
        $business_name  = $request['business_name'];
        $service_name   = $request['service_name'];
        $content        = $request['content'];

        $post_id = $this->get_post_id( $business_name,$service_name );

        $data = [
            'comment_approved'  => 1,
            'comment_content'   => $content,
            'comment_date'      => date('Y-m-d H:i:s'),
            'comment_post_ID'   => $post_id,
            'user_id'           => 0,
            'comment_meta'      => [
                'item_gender'   => $item_gender,
                'item_years'    => $item_years,
                'item_rating'   => $item_rating,
                'business_name'   => $business_name,
                'service_name'   => $service_name
            ]
        ];
        wp_insert_comment( $data );

        $return['status'] = 'OK';
        return rest_ensure_response( $return );
    }

    private function get_post_id($business_name,$service_name){
        global $AppDb,$wpdb;

        $AppDb->where ("meta_value","","!=");
        $AppDb->where ("meta_key","company_service_title");
        $post_ids = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['post_id']);

        $in_ids = [];
        if( count($post_ids) ){
            foreach ($post_ids as $post_id) {
               $in_ids[] = $post_id->post_id;
            }
        }else{
            return 0;
        }

        $AppDb->where ("meta_value","","!=");
        $AppDb->where ("post_id",$in_ids,"IN");
        $AppDb->where ("meta_key","company_business_name");

        $post_id = $AppDb->ObjectBuilder()->getOne ($wpdb->prefix."postmeta",['post_id']);
        if($post_id) return $post_id->post_id;
        return 0;

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