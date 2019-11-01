<?php

function e($sub_field) {

    echo get_sub_field( $sub_field);

}

function g($sub_field) {

    return get_sub_field( $sub_field);

}

function variables() {

    return array(

        'url_home'          => get_bloginfo('template_url') . '/',
        'assets'            => get_bloginfo('template_url') . '/assets/',
        'setting_home'      => get_option('page_on_front'),
        'current_user'      => wp_get_current_user(),
        'current_user_ID'   => wp_get_current_user()->ID,
        'admin_ajax'        => get_bloginfo('url') . '/wp-admin/admin-ajax.php',
        'url'               => get_bloginfo('url'),
    );

}



function get_term_parent_id($term_id, $my_tax = 'product_cat') {

    if($term_id){
        while( $parent_id = wp_get_term_taxonomy_parent_id( $term_id, $my_tax ) ){
            $term_id = $parent_id;
        }

        if( $term_id == 5 )
            return false;
        else
            return $term_id;
    }else {
        return false;
    }

}

function escapeJavaScriptText($string) {
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
}

function custom_sort_by_square_and_price($s, $req) {

    if ($s['sort-square'] || $s['sort-price']) {

        $sort = ($s['sort-square']) ? 'square' : 'price';

        $order = ($s['sort-square']) ? $s['sort-square'] : $s['sort-price'];

        if ($s['square']) {

            $arr = explode("-", $s['square']);

            $temp = array(
                'key' => 'square',
                'value' => $arr,
                'type' => 'numeric',
                'compare' => 'BETWEEN'
            );

            $req['meta_query'][] = $temp;

        }

        if ($s['price-min']) {

            $arr = array($s['price-min'], $s['price-max']);

            $temp = array(
                'key' => 'price',
                'value' => $arr,
                'type' => 'numeric',
                'compare' => 'BETWEEN'
            );

            $req['meta_query'][] = $temp;

        }

        $req['meta_key'] = $sort;
        $req['orderby'] = 'meta_value_num';
        $req['order'] = $order;

    } elseif ($s['square'] && !$s['price-min']) {
        $arr = explode("-", $s['square']);
        $req['meta_query'] = array(
            'key' => 'square',
            'value' => $arr,
            'type' => 'numeric',
            'compare' => 'BETWEEN'
        );

        $req['meta_key'] = 'square';
        $req['orderby'] = 'meta_value_num';
        $req['order'] = ($s['sort-square']) ? ($s['sort-square']) : 'ASC';

    }elseif ( $s['price-min'] && !$s['square'] ) {

        $arr = array($s['price-min'], $s['price-max']);

        $req['meta_query'] = array(
            'key' => 'price',
            'value' => $arr,
            'type' => 'numeric',
            'compare' => 'BETWEEN'
        );

        $req['meta_key'] = 'price';
        $req['orderby'] = 'meta_value_num';
        $req['order'] = ($s['sort-price']) ? ($s['sort-price']) : 'ASC';

    }elseif ($s['price-min'] && $s['square']) {

        $arr = explode("-", $s['square']);

        $temp = array(
            'key' => 'square',
            'value' => $arr,
            'type' => 'numeric',
            'compare' => 'BETWEEN'
        );

        $req['meta_query'][] = $temp;

        $arr1 = array($s['price-min'], $s['price-max']);

        $temp1 = array(
            'key' => 'price',
            'value' => $arr1,
            'type' => 'numeric',
            'compare' => 'BETWEEN'
        );

        $req['meta_query'][] = $temp1;

        $req['meta_key'] = 'price';
        $req['orderby'] = 'meta_value_num';
        $req['order'] = 'ASC';

    }

    return $req;

}

function get_min_price_with_projects() {

    $query = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $result = 1000000000;

    $wp_query = new WP_Query($query);

    if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();

        $price = (int) get_field('price');

        if($price < $result) $result = $price;

    endwhile; endif;

    wp_reset_query();

    return $result;

}

function get_max_price_with_projects() {

    $query = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $result = 0;

    $wp_query = new WP_Query($query);

    if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();

        $price = (int) get_field('price');

        if($price > $result) $result = $price;

    endwhile; endif;

    wp_reset_query();

    return $result;

}

function steps_for_range($steps = 6) {

    $max = get_max_price_with_projects();

    $step = $max / $steps;

    $arr = array();

    $arr[] = get_min_price_with_projects();

    $term_stap = get_min_price_with_projects();

    for($i = 1; $i<=$steps-1; $i++) {

        $term_stap = $term_stap + $step;

        $arr[] = (int) $term_stap;

    }
    $arr[] = $max;

    return $arr;
}
