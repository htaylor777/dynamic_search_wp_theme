<?php

require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/global-images.php');

// add custom RestAPI field

function dynamic_custom_rest()
{
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {return get_the_author();},
    ));
}

add_action('custom_rest_api', 'dynamic_custom_rest');

function pageBanner($args = null)
{
// NULL allows args optional to functions
    // from page.php, page-*.php, single-*.php
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }

    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');

    }

    if (!$args['bannerimage']) {
        if (get_field('page_banner_background_image')) { // if image passed here then get the uploaded image and size
            $args['bannerimage'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['bannerimage'] = INDEX_IMAGE; // else display default image
        }
    }

// formats single-professors.php banner,  subtitle and picture:
    ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image:
url(<?php echo $args['bannerimage'] ?>);">
    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle']; ?></p>
        </div>
    </div>
</div>

<?php }

function university_files()
{
    wp_enqueue_script('googleMap',
        '//maps.googleapis.com/maps/api/js?key=AIzaSyDKfuv7jgHqjWx80NMc77lyEGs0JrmGWDU',
        null, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), null, '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri());
    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
    ));
}

add_action('wp_enqueue_scripts', 'university_files');

// initiate google API Key

function universityMapKey($api)
{
    $api['key'] = 'AIzaSyDKfuv7jgHqjWx80NMc77lyEGs0JrmGWDU';
    return $api;

}

add_filter('acf/fields/google_map/api', 'universityMapKey');

//===================================================================================

// custom posts in the mu(must use) plugins folder:
// this is so we cannot inadvertely mess up our custom plugins and access:

/*
function university_event_posts()
{
//CAMPUS post type
register_post_type('campus', array(
'supports' => array('title', 'editor', 'excerpt'),
'rewrite' => array('slug' => 'campuses'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'Campuses',
'add_new_item' => 'Add New Campus',
'edit_item' => 'Edit Campus',
'all_items' => 'All Campuses',
'singular_name' => 'Campus',
),
'menu_icon' => 'dashicons-location-alt',
));

//Event post type
register_post_type('event', array(
'show_in_rest' => true,
'supports' => array('title', 'editor', 'excerpt'),
'rewrite' => array('slug' => 'events'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'Events',
'add_new_item' => 'Add New Event',
'edit_item' => 'Edit Event',
'all_items' => 'All Events',
'singular_name' => 'Event',
),
'menu_icon' => 'dashicons-calendar',
));
// Program post type
register_post_type('ujprograms', array(
'show_in_rest' => true,
'supports' => array('title', 'editor'),
'rewrite' => array('slug' => 'ujprograms'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'Programs',
'add_new_item' => 'Add New Program',
'edit_item' => 'Edit Program',
'all_items' => 'All Programs',
'singular_name' => 'Programs',
),
'menu_icon' => 'dashicons-screenoptions',
));
}

function university_professor_posts()
{
register_post_type('professor', array(
'show_in_rest' => true,
'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
'public' => true,
'has_archive' => true,
'labels' => array(
'name' => 'Professors',
'add_new_item' => 'Add New Professor',
'edit_item' => 'Edit Professor',
'all_items' => 'All Professors',
'singular_name' => 'Professor',
),
'menu_icon' => 'dashicons-admin-users',
));
}

function musical_instrument_catagories()
{
register_post_type('ensembles', array(
'show_in_rest' => true,
'supports' => array('title', 'editor', 'excerpt'),
'rewrite' => array('slug' => 'ensembles'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'PI Ensembles',
'add_new_item' => 'Add New Ensemble',
'edit_item' => 'Edit Ensemble',
'all_items' => 'All Ensembles',
'singular_name' => 'Ensemble',
),
'menu_icon' => 'dashicons-groups',
));

register_post_type('labs', array(
'show_in_rest' => true,
'supports' => array('title', 'editor', 'excerpt'),
'rewrite' => array('slug' => 'labs'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'PI Labs',
'add_new_item' => 'Add New Lab',
'edit_item' => 'Edit Lab',
'all_items' => 'All Labs',
'singular_name' => 'Lab',
),
'menu_icon' => 'dashicons-welcome-learn-more',
));

register_post_type('privatelesson', array(
'show_in_rest' => true, // this allows this to be part of the search parameter in the API
'supports' => array('title', 'editor', 'excerpt'),
'rewrite' => array('slug' => 'privatelesson'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'PI Private Lesson',
'add_new_item' => 'Add New PrivateLesson',
'edit_item' => 'Edit PrivateLesson',
'all_items' => 'All PrivateLessons',
'singular_name' => 'PrivateLessons',
),
'menu_icon' => 'dashicons-businessman',
));

register_post_type('orchestra', array(
'supports' => array('title', 'editor', 'excerpt'),
'rewrite' => array('slug' => 'orchestra'),
'has_archive' => true,
'public' => true,
'labels' => array(
'name' => 'PI Orchestra',
'add_new_item' => 'Add New Orchestra',
'edit_item' => 'Edit Orchestra',
'all_items' => 'All Orchestras',
'singular_name' => 'Orchestra',
),
'menu_icon' => 'dashicons-star-empty',
));

}

function university_features()
{
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_image_size('professorLandscape', 400, 400, true);
add_image_size('professorPortrait', 480, 650, true);
add_image_size('pageBanner', 1500, 350, true);

}

add_action('after_setup_theme', 'university_features');
add_action('init', 'university_event_posts');
add_action('init', 'university_professor_posts');
add_action('init', 'musical_instrument_catagories');
 */
?>