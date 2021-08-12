<?php
class Fund_Route extends WP_REST_Controller  {

    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crowfunding';
        $this->rest_base = 'funds';
        $this->post_slug = 'fund';
        $this->home_url  = get_option('siteurl');
        $this->meta_fields = [
            'fund_values_guarantee',
            'fund_values_operation_period',
            'fund_values_planned_distribution_rate',
            'fund_values_total_offer',
            'company_business_name',
        ];
        $this->single_meta_fields = array_merge($this->meta_fields,[
            'fund_values_minimum_amount',
            'fund_values_investment_amount',
            'fund_values_dividend_date',
            'fund_values_recruitment_period',
            'gallery',
            'recruitment_outline_total_offer',
            'recruitment_outline_operation_type',
            'recruitment_outline_recruitment_method',
            'recruitment_outline_number_of_lenders',
            'recruitment_outline_expected_yield',
            'recruitment_outline_scheduled_redemption_date',
            'recruitment_outline_recruitment_start_date',
            'recruitment_outline_investment_execution_date',
            'recruitment_outline_redemption_method_principal',
            'recruitment_outline_redemption_method_profit_dividend',
            'recruitment_outline_redemption_method_early_redemption',
            'recruitment_outline_redemption_method',
            'recruitment_outline_collateral'
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
        $cat_id     = ( isset($request['cat_id']) ) ? $request['cat_id'] : 0;
        $page       = ( isset($request['page']) ) ? $request['page'] : 1;
        $limit      = ( isset($request['limit']) ) ? $request['limit'] : 10;
        $have_guarante      = ( isset($request['have_guarante']) ) ? $request['have_guarante'] : 0;
        $have_no_guarante   = ( isset($request['have_no_guarante']) ) ? $request['have_no_guarante'] : 0;


        $cols = ['ID','post_title','post_name','post_excerpt','comment_count'];

        $AppDb->where ("post_type",'fund');
        $AppDb->where ("post_status",'publish');
        $totalPages = 1;

        if($have_guarante && $have_no_guarante){
            $AppDb->join($wpdb->prefix."postmeta pm", "pm.post_id=p.ID");
            $AppDb->where ("pm.meta_key","fund_values_guarantee");
            $AppDb->where ("pm.meta_value",[0,1],"IN");
            //$db->joinWhere("posts as p", "pm.meta_key", 5);
        }elseif($have_guarante){
            $AppDb->join($wpdb->prefix."postmeta pm", "pm.post_id=p.ID");
            $AppDb->where ("pm.meta_key","fund_values_guarantee");
            $AppDb->where ("pm.meta_value",[1],"IN");
        }elseif($have_no_guarante){
            $AppDb->join("postmeta pm", "pm.post_id=p.ID");
            $AppDb->where ("pm.meta_key","fund_values_guarantee");
            $AppDb->where ("pm.meta_value",[0],"IN");
        }

        if( $pagination ){
            $AppDb->pageLimit = $limit;
            $items = $AppDb->ObjectBuilder()->paginate($wpdb->prefix."posts as p", $page,$cols);
            $totalPages = $AppDb->totalPages;
        }else{
            $items = $AppDb->ObjectBuilder()->get ($wpdb->prefix."posts as p", $limit, $cols);
        }

        foreach ($items as $item) {
            $item->post_link    = $this->home_url.'/'.$this->post_slug.'/'.$item->post_name;
            $item->post_image   = $this->home_url.'/images/product-1.png';
            $item->post_image   = wp_get_attachment_url( get_post_thumbnail_id($item->ID) );
            $features     = get_the_terms($item->ID,'fund_features');
            $item->features_html= '';
            foreach ($features as $feature) {
               //$item->features_html .= '<li><a href="">'.$feature->name.'</a></li>';
               $item->features_html .= '<li>'.$feature->name.'</li>';
            }

            $AppDb->where ("post_id",$item->ID);
            $AppDb->where ("meta_key",$this->meta_fields,"IN");
            $metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['meta_key','meta_value']);

            foreach ($metas as $meta) {
                if( $meta->meta_key == 'fund_values_total_offer' ){
                    $meta->meta_value = number_format($meta->meta_value);
                }
                if( $meta->meta_key == 'fund_values_guarantee' ){
                    $meta->meta_value = ($meta->meta_value) ? '有り' : '違う';
                }
                if( $meta->meta_key == 'company_business_name' ){
                    $meta->meta_value = ($meta->meta_value) ? $meta->meta_value : 'クラウドビルズ';
                }
                $item->{$meta->meta_key} = $meta->meta_value;
            }
        }

        $return['items']        = $items;
        $return['totalPages']   = $totalPages;

        return rest_ensure_response( $return );
    }
    /**
     * Create item response
     */
    public function show( $request ) {

        global $AppDb,$wpdb;
        $item_id = $request['id'];

        $cols = ['ID','post_title','post_name','post_content','comment_count'];

        $AppDb->where ("ID",$item_id);
        $AppDb->where ("post_type",'fund');
        $AppDb->where ("post_status",'publish');
        $item = $AppDb->ObjectBuilder()->getOne ($wpdb->prefix."posts",$cols);

        $item->post_link    = $this->home_url.'/'.$this->post_slug.'/'.$item->post_name;
        $item->post_image   = $this->home_url.'/images/product-1.png';
        $item->post_image   = wp_get_attachment_url( get_post_thumbnail_id($item->ID) );
        
        $features     = get_the_terms($item_id,'fund_features');
        $item->features_html= '';
        foreach ($features as $feature) {
           //$item->features_html .= '<li><a href="">'.$feature->name.'</a></li>';
           $item->features_html .= '<li>'.$feature->name.'</li>';
        }

        $AppDb->where ("post_id",$item->ID);
        $AppDb->where ("meta_key",$this->single_meta_fields,"IN");
        $metas = $AppDb->ObjectBuilder()->get ($wpdb->prefix."postmeta", null, ['meta_key','meta_value']);

        foreach ($metas as $meta) {
            if( $meta->meta_key == 'gallery' ){
                $meta->meta_value = unserialize($meta->meta_value);
                $meta->meta_value = get_field('gallery',$item_id);
            }
            if( $meta->meta_key == 'fund_values_total_offer' ){
                $meta->meta_value = number_format($meta->meta_value);
            }
            $item->{$meta->meta_key} = $meta->meta_value;
        }

        return rest_ensure_response( $item );
    }
    public function store( $request ) {}

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