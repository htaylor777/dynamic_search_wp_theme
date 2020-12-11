<?php
// this is the home page: - the index is the blog page
// remember to set in dashboard Settings -> Read and change these 2 page locations
// in order for the posts to post correctly
get_header();

?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo INDEX_IMAGE ?>);"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">H1 Header!</h1>
        <h2 class="headline headline--medium">H2 Subheader </h2>
        <h3 class="headline headline--small">H3 SubHeader</h3>
        <a href="<?php echo get_post_type_archive_link('ujprograms'); ?>" class="btn btn--large btn--blue">Button to Do
            Somthing</a>


    </div>
</div>

<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">

            <!-- =======================EVENTS=========================================== -->
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
            <?php
// set event date from dashboard:
$homeEventPosts = new WP_Query(array(
    'posts_per_page' => 3, // shows most closest 3 events from today
    // 'posts_per_page' => -1, // all which is -1
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC', // ascending order
    'meta_query' => array(
        array(
            'key' => 'event_date', // event_date >= todays date (type is (numeric))
            'compare' => '>=',
            'value' => TODAY,
            'type' => 'numeric',
        ))));

while ($homeEventPosts->have_posts()) {
    $homeEventPosts->the_post();
    get_template_part('template-parts/content', 'event');
}?>

            <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>"
                    class="btn btn--blue">View All Events</a></p>
        </div>
    </div>


    <!--  ============== begin right yellow block BLOGS===================== -->
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Our Blog Posts!</h2>
            <?php

// custom query - get an excerpt of te 2 most visited posts:
$homePagePosts = new WP_Query(array(
    'posts_per_page' => 2,
));
while ($homePagePosts->have_posts()) {
    $homePagePosts->the_post();?>
            <div class="event-summary">
                <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink();?>">
                    <span class="event-summary__month"><?php the_time('M');?></span>
                    <span class="event-summary__day"><?php the_time('d');?></span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a
                            href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                    <p><?php
// handle front-page exerpts:
    // from dashboard implemented excerpts
    // on posts vs the ones that are not implemented:
    if (has_excerpt()) {
        echo get_the_excerpt();
    } else {
        echo wp_trim_words(get_the_content(), 18);
    }?>
                        <a href="<?php the_permalink();?>" class="nu gray">Read more</a></p>
                </div>
            </div>
            <?php }
//reset query: always put this function after while loops
wp_reset_postdata();?>


            <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All
                    Blog Posts</a></p>
        </div>
    </div>
</div>



<div class="hero-slider">

    <div class="hero-slider__slide" style="background-image: url(<?php echo BUS_IMAGE; ?>)">
        <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Transportation</h2>
                <p class="t-center">All students have free unlimited shuttle fare.</p>
                <p class="t-center no-margin"><a href="<?php echo site_url('/free-shuttle-bus-schedule'); ?>"
                        class="btn btn--blue">Learn more</a></p>
            </div>
        </div>
    </div>

    <div class="hero-slider__slide" style="background-image: url(<?php echo APPLES_IMAGE; ?>)">
        <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                <p class="t-center">Our health program tip of the day.</p>
                <p class="t-center no-margin"><a href="<?php echo site_url('/healthtip') ?>" class="btn btn--blue">Learn
                        more</a></p>
            </div>
        </div>
    </div>

    <div class="hero-slider__slide" style="background-image: url(<?php echo BREAD_IMAGE; ?>)">
        <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Food</h2>
                <p class="t-center">Jazz Music University offers lunch plans for those in need.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
?>