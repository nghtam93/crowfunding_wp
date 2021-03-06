<?php
class Lending_Route extends WP_REST_Controller  {

    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crowfunding';

        $this->rest_base        = 'lendings';
        $this->post_slug = 'lending';
        $this->home_url  = get_option('siteurl');
        $this->meta_fields = [
            'company_business_name',
            'company_service_title',
        ];
        $this->single_meta_fields = array_merge($this->meta_fields,[
            'recruitment_outline_administrative_disposition',
            'recruitment_outline_bad_debt',
            'recruitment_outline_deposit_bank',
            'recruitment_outline_account_type',
            'recruitment_outline_yield',
            'recruitment_outline_board_member',
            'recruitment_outline_shareholders',
            'recruitment_outline_address',
            'recruitment_outline_set_up',
            'recruitment_outline_operation_type',
            'features',
            'table_of_contents',
        ]);

        $this->reviews_meta_fields = [
            'item_rating',
        ];
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
        $get_total_review      = ( isset($request['total_reviews']) ) ? $request['total_reviews'] : false;

        $cols = ['ID','post_title','post_name','post_excerpt'];

        $AppDb->where ("post_type",'lending');
        $AppDb->where ("post_status",'publish');
        $totalPages = 1;

        if( $pagination ){
            $AppDb->pageLimit = $limit;
            $items = $AppDb->ObjectBuilder()->paginate($wpdb->prefix."posts as p", $page,$cols);
            $totalPages = $AppDb->totalPages;
        }else{
            $items = $AppDb->ObjectBuilder()->get ($wpdb->prefix."posts as p", $limit, $cols);
        }

        foreach ($items as $item) {
            $item->post_link    = $this->home_url.'/'.$this->post_slug.'/'.$item->post_name;
            $item->post_image   = $this->home_url.'/images/company-1.png';
            $item->post_image   = wp_get_attachment_url( get_post_thumbnail_id($item->ID) );
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
                if( $meta->meta_key == 'features' ){
                    $meta->meta_value = get_field('features',$item->ID);
                }
                $item->{$meta->meta_key} = $meta->meta_value;
            }

            if($get_total_review){
                $AppDb->where ("comment_post_ID",$item->ID);
                $reviews = $AppDb->ObjectBuilder()->get ($wpdb->prefix."comments", null, ['comment_post_ID','comment_ID']);
                $item->total_reviews    = count($reviews);
                $item->average_rating   = '0%';
                $item->average_value    = 0;
                if( count($reviews) ){
                    $comment_values = [];
                    foreach ($reviews as $review) {
                        $comment_post_ID    = $review->comment_post_ID;
                        $comment_ID         = $review->comment_ID;
                        $AppDb->where ("comment_id",$comment_ID);
                        $AppDb->where ("meta_key",$this->reviews_meta_fields,"IN");
                        $comment_metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."commentmeta", null, ['meta_key','meta_value']);

                        
                        foreach ($comment_metas as $key => $comment_meta) {
                            if( $comment_meta->meta_key == 'item_rating' ){
                                $comment_values[] = $comment_meta->meta_value;
                            }
                        }
                    }

                    $item->average_rating = ( array_sum($comment_values)/count($reviews) / 5 ) * 100 .'%';
                    $item->average_value  = array_sum($comment_values)/count($reviews);
                }

            }
        }

        $return['items']        = $items;
        $return['totalPages']   = $totalPages;


        return rest_ensure_response( $return );
    }

    public function show( $request ) {

        global $AppDb,$wpdb;
        $item_id = $request['id'];

        $cols = ['ID','post_title','post_name','post_content','comment_count'];

        $AppDb->where ("ID",$item_id);
        $AppDb->where ("post_type",'lending');
        $AppDb->where ("post_status",'publish');
        $item = $AppDb->ObjectBuilder()->getOne ($wpdb->prefix."posts",$cols);

        $item->post_link    = $this->home_url.'/'.$this->post_slug.'/'.$item->post_name;
        $item->post_image   = $this->home_url.'/images/product-1.png';
        $item->post_image   = wp_get_attachment_url( get_post_thumbnail_id($item->ID) );
        

        $AppDb->where ("post_id",$item->ID);
        $AppDb->where ("meta_key",$this->single_meta_fields,"IN");
        $metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['meta_key','meta_value']);

        foreach ($metas as $meta) {
            if( $meta->meta_key == 'features' ){
                $meta->meta_value = get_field('features',$item->ID);
            }
            if( $meta->meta_key == 'table_of_contents' ){
                $meta->meta_value = get_field('table_of_contents',$item->ID);
            }
            $item->{$meta->meta_key} = $meta->meta_value;
        }

        return rest_ensure_response( $item );
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