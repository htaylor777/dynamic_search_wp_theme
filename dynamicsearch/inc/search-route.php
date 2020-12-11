<?php

add_action('rest_api_init', 'dynamicRegisterSearch');

function dynamicRegisterSearch()
{
    register_rest_route('dynamic/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'dynamicSearchResults',
    ));
}

function dynamicSearchResults($data)
{
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page'),
        's' => sanitize_text_field($data['term']),
    ));

    $results = array(
        'postget' => array(),
        'pageget' => array(),
    );

    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if (get_post_type() == 'post') {
            array_push($results['postget'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author(),
            ));
        }

        if (get_post_type() == 'page') {
            array_push($results['pageget'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author(),
            ));
        }
    }

    return $results;

}