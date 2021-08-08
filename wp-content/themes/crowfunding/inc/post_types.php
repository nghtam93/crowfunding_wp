<?php
function post_type_crowfunding_init() {
    $labels = array(
        'name'                  => _x( 'Funds', 'Post type general name', 'crowfunding' ),
        'singular_name'         => _x( 'Fund', 'Post type singular name', 'crowfunding' ),
        'menu_name'             => _x( 'Funds', 'Admin Menu text', 'crowfunding' ),
    ); 
    $args = array(
        'labels'             => $labels,
        'description'        => 'Fund custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'fund' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'taxonomies'         => array( 'fund_categories','fund_features' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'Fund', $args );

    /*
    register_taxonomy(
        'fund_categories',
        'fund',
        array(
            'hierarchical' => true,
            'label' => 'Fund categories',
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'fund-categories',
                'with_front' => false
            )
        )
    );
    */

    register_taxonomy(
        'fund_features',
        'fund',
        array(
            'hierarchical' => true,
            'label' => 'Fund features',
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'fund-features',
                'with_front' => false
            )
        )
    );

    $labels = array(
        'name'                  => _x( 'Lendings', 'Post type general name', 'crowLendinging' ),
        'singular_name'         => _x( 'Lending', 'Post type singular name', 'crowLendinging' ),
        'menu_name'             => _x( 'Lendings', 'Admin Menu text', 'crowLendinging' ),
    ); 
    $args = array(
        'labels'             => $labels,
        'description'        => 'Lending custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'lending' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'taxonomies'         => array(),
        'show_in_rest'       => true
    );
      
    register_post_type( 'Lending', $args );
}
add_action( 'init', 'post_type_crowfunding_init' );